<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call(AgendasTableSeeder::class);
        $this->call(RolesTableSeeder::class);
        $this->call(PACTableSeeder::class);
        $this->call(UsersTableSeeder::class);
        $this->call(CategoriesTableSeeder::class);
        $this->call(HomeTableSeeder::class);
        $this->call(CategoryBooksTableSeeder::class);
        $this->call(CommentsTableSeeder::class);
        $this->call(ContactsTableSeeder::class);
        $this->call(HBNTableSeeder::class);
        $this->call(MembersTableSeeder::class);
        $this->call(AdministratorsTableSeeder::class);
        $this->call(NewsTableSeeder::class);
        $this->call(TagsTableSeeder::class);
        $this->call(NewsTagsTableSeeder::class);
        $this->call(ProfilesTableSeeder::class);
        $this->call(QuotesTableSeeder::class);
        $this->call(ClassificationTableSeeder::class);
        $this->call(LetterStatusTableSeeder::class);
        $this->call(LetterTableSeeder::class);
        $this->call(DispositionTableSeeder::class);
    }
}
