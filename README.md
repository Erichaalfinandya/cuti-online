1. db > table > users
LOAD DATA INFILE 'C:/ProgramData/MySQL/MySQL Server 8.0/Uploads/users.csv' //disesuaikan
INTO TABLE users
CHARACTER SET utf8mb4
FIELDS TERMINATED BY ','
OPTIONALLY ENCLOSED BY '"'
LINES TERMINATED BY '\n'
IGNORE 1 ROWS
(@no, nip, nama, jabatan, golongan)
SET password = '',
created_at = NOW(),
updated_at = NOW();

2. php artisan tinker
3. use App\Models\UserModel;

use Illuminate\Support\Facades\Hash;

UserModel::chunk(100, function ($users) {

foreach ($users as $user) {

$user->password = Hash::make($user->nip);

$user->save();

}

});


. php artisan db:seed
