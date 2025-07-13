<?php

require_once 'vendor/autoload.php';

$app = require_once 'bootstrap/app.php';
$app->make('Illuminate\Contracts\Console\Kernel')->bootstrap();

use App\Models\User;
use App\Models\LadisaVisitor;
use App\Models\LadisaBooking;

echo "=== FIXING VISITOR DATA ===\n";

// Get user data
$user = User::where('email', 'user@example.com')->first();
if (!$user) {
    echo "User not found!\n";
    exit;
}

echo "User: {$user->name} ({$user->email})\n";

// Check if visitor exists with user email
$visitor = LadisaVisitor::where('email', $user->email)->first();

if (!$visitor) {
    echo "Creating new visitor with user email...\n";
    
    // Create new visitor with user data
    $visitor = LadisaVisitor::create([
        'nama' => $user->name,
        'email' => $user->email,
        'telepon' => '081234567890', // Default phone
        'alamat' => 'Alamat default'
    ]);
    
    echo "Created visitor: {$visitor->nama} ({$visitor->email})\n";
} else {
    echo "Visitor already exists: {$visitor->nama} ({$visitor->email})\n";
}

// Now create a test booking for this user
echo "\nCreating test booking...\n";

// Get first room
$room = \App\Models\LadisaRoom::first();
if ($room) {
    $booking = LadisaBooking::create([
        'visitor_id' => $visitor->id,
        'room_id' => $room->id,
        'checkin' => '2025-01-15',
        'checkout' => '2025-01-17',
        'status' => 'pending'
    ]);
    
    echo "Created booking: {$booking->id} for room {$room->nama}\n";
} else {
    echo "No rooms found!\n";
}

echo "\n=== VERIFICATION ===\n";
$userBookings = LadisaBooking::where('visitor_id', $visitor->id)->get();
echo "Total bookings for user: " . $userBookings->count() . "\n";

foreach($userBookings as $booking) {
    echo "- Booking {$booking->id}: {$booking->room->nama} - {$booking->status}\n";
} 