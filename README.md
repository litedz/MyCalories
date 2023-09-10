# MyCal (My Calories)

MyCal is a web application built using Laravel, Livewire, and Alpine.js to help you track your daily calorie intake and manage your diet effectively.

![MyCal Screenshot](screenshot.png)

## Features

- **User Authentication:** Secure user registration and login system.
- **Calorie Tracking:** Easily record and monitor your daily calorie intake.
- **Food Database:** Search and add foods to your meals from a pre-populated database.
- **Meal Management:** Create, update, and delete meals with ease.
- **Dashboard:** Visualize your daily and weekly calorie consumption.
- **Responsive Design:** Access MyCal on various devices - desktop, tablet, and mobile.

## Installation

To run MyCal on your local machine, follow these steps:

1. Clone the repository:

   ```bash
   git clone https://github.com/yourusername/mycal.git


1.Navigate to the project directory:

   ```bash
   cd composer install
```
2.Install PHP dependencies:

   ```bash
   composer install
```
3.Copy the .env.example file to .env and configure your database credentials:

   ```bash
   cp .env.example .env
```
4.Generate the application key:

   ```bash
   php artisan key:generate
```
5.Create and migrate the database:

   ```bash
   php artisan migrate
```
6.Install JavaScript dependencies:

   ```bash
   npm install 
```
7.Build the assets:

   ```bash
   npm run dev
```
## Contributing

If you'd like to contribute to MyCal, please follow these guidelines:
- Fork the repository.
- Create a new branch for your feature or bug fix.
- Make your changes and test them thoroughly.
- Commit your changes with clear commit messages.
- Push your branch to your forked repository.
- Create a pull request with a detailed description of your changes.


## Acknowledgments
- PHP 8.x
- Laravel
- Livewire
- Alpine.js

