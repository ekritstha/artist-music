<?php

namespace App\Imports;

use App\Repositories\ArtistRepository;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithMapping;

class ArtistImport implements ToCollection, WithHeadingRow, WithMapping
{
    private $artistRepo;

    public function __construct(ArtistRepository $artistRepo)
    {
        $this->artistRepo = $artistRepo;
    }

    public function collection($rows)
    {
        foreach ($rows as $row) {
            $data = $row;
            $this->artistRepo->store($data);
        }
    }

    public function map($row): array
    {
        $gender = $row['gender'];

        if ($gender === 'Male') {
            $gender = 'm';
        } elseif ($gender === 'Female') {
            $gender = 'f';
        } else {
            $gender = 'o';
        }
        return [
            'name' => $row['name'],
            'dob' => $row['date_of_birth'],
            'gender' => $gender,
            'address' => $row['address'],
            'first_release_year' => $row['first_release_year'],
            'no_of_albums_released' => $row['number_of_albums_released'],
        ];
    }
}
