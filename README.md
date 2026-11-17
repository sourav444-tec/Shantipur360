# Santipur360 – PHP / MySQL

## Local setup (XAMPP)
1. Copy this project folder into `C:\\xampp\\htdocs\\Shantipur360`.
2. Start **Apache** and **MySQL** in XAMPP.
3. Open `http://localhost/phpmyadmin`, create/import the database by importing `database/santipur_rash.sql`.
4. Check `includes/db.php`. Default settings are database `santipur_rash`, user `root`, blank password (default XAMPP only).
5. Open `http://localhost/Shantipur360/`.
6. Open `http://localhost/Shantipur360/admin/`. On first visit, create the first admin username and a strong password (at least 12 characters). Later visits show the login form.

## Admin features
- Add/edit/delete pandals, bigraha houses, transport stops, helplines and other places.
- Enter verified latitude/longitude; published records appear as pins on the responsive OpenStreetMap map.
- Full-screen map control; markers open place details.
- Upload/delete festival photos and review/delete visitor feedback.

## Photos
Six supplied festival photographs are in `assets/images/rash-01.jpg` through `rash-06.jpg` and are assigned to the existing homepage/page image slots.

## Important production checklist
- Change DB credentials in `includes/db.php` to a dedicated MySQL user with a strong password.
- Use HTTPS, restrict `/admin/` access where possible, keep PHP/MySQL updated and back up the database/uploads directory.
- Do not publish guessed emergency phone numbers or coordinates. Admin must enter verified information.
- Map tiles need an internet connection. The map uses Leaflet and OpenStreetMap.
