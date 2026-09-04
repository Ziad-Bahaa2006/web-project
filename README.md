# Fight Arena — Games Store

A multi-page web application for browsing, purchasing, and managing an account
on a fictional games storefront ("Fight Arena"). Built as a front-end +
PHP backend project.

## Pages

| Page | Description |
|---|---|
| `pages/home/` | Landing page — featured games, news, store preview, leaderboard |
| `pages/game/` | Game listing and sign-up flow |
| `pages/profile/` | User profile with stats pulled from the database |
| `pages/cart/` | Cart and payment flow |
| `pages/contact/` | Contact form |
| `pages/about/` | About page |
| `pages/game-details/` | Individual game details page |

## Tech stack

- **Frontend:** HTML, CSS, vanilla JavaScript
- **Backend:** PHP (`mysqli` and `PDO` for MySQL, `pg_connect` for PostgreSQL)
- **Database:** MySQL / PostgreSQL (see `backend/database/players_info.sql` for schema)

## Running locally

1. Install [XAMPP](https://www.apachefriends.org/) (or any Apache + MySQL + PHP stack).
2. Copy this repo into your `htdocs` folder.
3. Create the databases referenced in the PHP files and import
   `backend/database/players_info.sql`.
4. Copy `.env.example` to `.env` and fill in your local database credentials
   (see below).
5. Start Apache + MySQL/PostgreSQL from the XAMPP control panel.
6. Open `http://localhost/web-project/home_page/home_page.html` in your browser.

## Environment variables

This project expects database credentials to be supplied via environment
variables rather than hardcoded in PHP files. Create a `.env` file (not
committed to git) with:

```
DB_HOST=localhost
DB_NAME=your_db_name
DB_USER=your_db_user
DB_PASSWORD=your_db_password
```

## Known issues / roadmap

- Database access is currently split across `mysqli`, `PDO`, and `pg_connect`
  in different files — consolidating to one approach (PDO) is planned.
- Some pages still use placeholder images (`via.placeholder.com`).

## License

See [LICENSE](LICENSE) (MIT).
