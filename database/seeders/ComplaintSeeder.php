<?php

namespace Database\Seeders;

use App\Models\Complaint;
use App\Models\ComplaintPhoto;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Storage;

class ComplaintSeeder extends Seeder
{
    public function run(): void
    {
        $user = User::first() ?? User::factory()->create();

        $categories = ['afval','verlichting','wegen','groen','overlast'];

        for ($i=1; $i<=10; $i++) {
            $lat = $this->randFloat(51.905, 51.925);
            $lng = $this->randFloat(4.31, 4.37);
            $c = Complaint::create([
                'title' => 'Testklacht '.$i,
                'description' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer nec odio. Praesent libero. Sed cursus ante dapibus diam.',
                'category' => $categories[array_rand($categories)],
                'status' => 'in_behandeling',
                'lat' => $lat,
                'lng' => $lng,
                'reporter_name' => 'Jan Jansen',
                'reporter_email' => 'jan'.$i.'@example.test',
                'user_id' => $user->id,
            ]);

            // 0–2 photos
            $photos = rand(0,2);
            for ($p=0; $p<$photos; $p++) {
                $path = $this->putPlaceholder($c->id);
                ComplaintPhoto::create([
                    'complaint_id' => $c->id,
                    'path' => $path,
                ]);
            }
        }
    }

    private function randFloat(float $min, float $max): float
    {
        return $min + mt_rand() / mt_getrandmax() * ($max - $min);
    }

    // Store a small placeholder PNG and return relative path
    private function putPlaceholder(int $complaintId): string
    {
        $dir = "complaints/{$complaintId}";
        $filename = uniqid().'.png';
        $path = $dir.'/'.$filename;
        $png = base64_decode(
            'iVBORw0KGgoAAAANSUhEUgAAAEAAAABACAYAAACqaXHeAAAAGXRFWHRTb2Z0d2FyZQBBZG9iZSBJ' .
            'bWFnZVJlYWR5ccllPAAABThJREFUeNrsW8Fu2zAM3Kf//2mQx7bI5ZLwQm3DW1jTQgkqXj8YB1sH' .
            '6SY2lGm1sG5oP8q0plb2m1w0o4rFZC9CzWw3b0gJxkW9oT4f3Yp7h7w9+0K8m8G1mFCpFZKkSgk8C' .
            'gCwR9x6tG3JYF6G+oQ5b7g9g0s1mHQ1S6i0YbQJQk0o8i8c1oY8h7kYgqA2m6n3aV4L3j7e2n9a0Q' .
            'k0k0iWmJ2bBvK2m6x6S8q8Xw2xgQmW4h1B5rQ2gk7Gq5iY5h1oK8rW6VqkYdCxyG0NqK0Zk8ZCv9Q' .
            'Q8Vg9Vof6r6Z0sCyq0s1qk3pXgk+6z1yY8C0j3Q4M8vY0j8i8Xq+6l4S8n2wzK9Zk9l6k8S0G0E0' .
            'qkYrFZrFf+Zr7m3Xg6Q5Nw8CwEoVqvVYqVfCwCwZrNZrNZrBfD47j8P4iIYgH3fQ3gZBEEQQRBEHg' .
            '2Wy2G0qlUpqmaY4HA7/f7/dut9u0WCweDwSCSiKIoijwD2H4O1mUxGo1G9vb3b7Xa7XU6nYbDbDb' .
            'DZrOZVqtVgqE0+n0cDgc2+0Gg0EoFAo0Gg0cDgclmUymQyZTCYvLy9oNBp9fX2Koii8vLxgMBjQar' .
            'Xb7fZ7Xa7s7Ozx+PxGJZl8Xg8zWaz9fX1i4uLQqFQv98n8J8mUwmEomEcrkcAEVR9n2fKpVKjUZDL' .
            '5ZJOp+PxeIyiKIo8z2fVqtVp9MJgMHBwex2Gx2u12s9lspkMqlUoHB4eIiIi4uLiQ0NDzGYz6/X6' .
            'nU6nCIIgZrMZg8Gg2WyWlZWV6/X6UlNT3G63w+GwWCwWi8UgCBgYGGBwcBDOzs7QarUSiUSr9cLv' .
            'djsymYz19fXxeDwqKyvB6/XidDrFYjFZLBaDwSCTySSn02k2m6ampvj9fpZlMRgMiqJgMBjQarUS' .
            'qVTi8XiCIIgYDAYfPz8kMvlmM/njY2NSqfTVqtV+v1+3W6XcDj8fHxQKBQhISF4PB6pVArFYrFUK' .
            'hUKhW63m5eWFm5ubmM1mYrEYh8Ph0Wg0Go0G0zTt7e20Wi3G43GZmZk0Go3QarVQKBRCQkKQSCQQ' .
            'CASC6/X6qK+vJ4fD8fHxQK/XI4/HQ0NDqNVqJEmSlEolAEVRhMNh0Wg0i8Xi7OzsqNVq2Gw2KpVK' .
            'KpUKk8kknU4nq9Xq3NzcMBgMktls4uPjQ6/Xw2w2Y2NjVCoVHh8fY7VaEQQB4PP5QqFQ8Pl8kMlk' .
            'YmNjg8FgqKqq0Gg0uLi4gEAg1Go1ZrMZrVYLhUJgMplkdnYWg8EgnU4ntVoNNpsNTdM0o9EoAD9k' .
            'gHkVtI7fG9gAAAAASUVORK5CYII='
        );
        Storage::disk('public')->put($path, $png);
        return $path; // relative
    }
}

