<?php declare(strict_types=1);

namespace Auth\Dev;

use Ottaviano\Faker\Gravatar;
use Sys\Fake\FakeSeeder;
use Sys\Fake\FakeSeederInterface;

class UserFakeSeeder extends FakeSeeder implements FakeSeederInterface
{
    const MODES = [
        'monsterid',
        'robohash',
        'wavatar',
    ];

    protected $table = 'users';
    private array $sex = ['female', 'male'];

    public function __construct(string $lang)
    {
        parent::__construct($lang);
        $this->faker->addProvider(new Gravatar($this->faker));
        $this->faker->addProvider(new UserFakeProvider($this->faker));
    }

    public function generate($seed = true): array
    {
        $sex = $this->faker->optional(0.8)->randomElement([0, 1]);
        $email = $this->faker->email();

        $fields = [
            'name' => $this->userName($this->sex[$sex] ?? null),
            'email' => $email,
            'phone' => $this->faker->optional(0.6)->numerify('###########'),
            'dob' => $this->faker->optional(0.6)->date('Y-m-d', '2006-01-01'),
            'sex' => $sex,
            'info' => $this->faker->optional(0.6)->json(fn() => ['baz' => 'ban']),
            'password' => password_hash($this->faker->password(3, 8), PASSWORD_BCRYPT),
            'created' => $this->faker->dateTimeBetween('-13 years')->format('Y-m-d h:i:s'),
            
        ];

        if ($seed) {
            $dir = config('upload', 'avatar');
            $this->avatar($dir, 0.6, $email);
        }

        return $fields;
    }

    private function avatar($dir, $probability = 0.6, ?string $email = null, int $size = 80)
    {
        $mode = $this->faker->randomElement(self::MODES);
        $filename = $this->faker->optional($probability)->gravatar($dir, $mode, $email, 80, true);
        $ext = pathinfo($filename, PATHINFO_EXTENSION);
        $new_filename = md5($email) . '.' . $ext;
        rename($filename, $dir . $new_filename);

        return $new_filename;
    }

    private function userName($gender = null)
    {
        if (!$gender) {
            $gender = $this->faker->randomElement($this->sex);
        }

        return $this->faker->firstName($gender) . ' ' . $this->faker->lastName($gender);
    }
}
