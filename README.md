# Hotel Survey System

ระบบแบบสอบถามสำหรับโรงแรม รองรับหลาย Hotel Profile, หลายภาษา (EN/TH) พร้อม Admin Panel

## Tech Stack

- **Backend:** Laravel 12 + PHP 8.3
- **Frontend:** Vue 3 (Composition API) + Inertia.js v2
- **Styling:** Tailwind CSS v4
- **Database:** MySQL 8.0
- **Infrastructure:** Docker Compose

## Features

- Multi Hotel Profile — แต่ละ profile มี logo, background, ข้อความ header/footer แยกกัน
- Survey Sections & Questions — จัดการแบบ dynamic ต่อ profile, ลากจัดลำดับด้วย drag & drop
- Survey Links — สร้างลิงก์แบบสอบถามผูกกับห้องพัก, มี slug สำหรับแชร์
- Survey Responses — เก็บคำตอบ Yes/No + Comment + Star Rating
- Multi-language — รองรับ EN/TH ทั้ง survey form และ validation messages
- Admin Panel — Dashboard, จัดการ profiles, rooms, sections, questions, links, users

## Project Structure

```
app/
├── Http/Controllers/
│   ├── AuthController.php          # Login/Logout
│   ├── DashboardController.php     # Admin dashboard
│   ├── HotelProfileController.php  # CRUD hotel profiles + image upload
│   ├── RoomController.php          # CRUD rooms per profile
│   ├── SurveyController.php        # Public survey form display + submit
│   ├── SurveyLinkController.php    # CRUD survey links
│   ├── SurveyResponseController.php# View submitted responses
│   ├── SurveySectionController.php # CRUD sections + drag & drop reorder
│   ├── SurveyQuestionController.php# CRUD questions + drag & drop reorder
│   └── UserController.php          # Manage admin users
├── Models/
│   ├── HotelProfile.php            # name, logo, background, titles, forms
│   ├── Room.php                    # belongs to HotelProfile
│   ├── SurveySection.php           # belongs to HotelProfile, has translations
│   ├── SurveySectionTranslation.php# title per locale
│   ├── SurveyQuestion.php          # belongs to Section, has translations
│   ├── SurveyQuestionTranslation.php# text per locale
│   ├── SurveyLink.php              # slug, group_name, belongs to Room
│   ├── SurveyResponse.php          # personal info + overall rating
│   ├── SurveyAnswer.php            # answer per question (yes/no + comment)
│   └── User.php                    # admin users
resources/js/
├── Components/
│   ├── Survey/
│   │   ├── LanguageSwitcher.vue    # EN/TH toggle
│   │   ├── StarRating.vue          # 5-star rating component
│   │   ├── SurveyQuestion.vue      # Yes/No buttons + comment input
│   │   └── SurveySection.vue       # Section card wrapper
│   └── UI/
│       ├── CopyButton.vue          # Copy to clipboard
│       └── Modal.vue               # Reusable modal dialog
├── Layouts/
│   ├── AdminLayout.vue             # Sidebar nav + flash messages
│   └── GuestLayout.vue             # Public layout with logo/background
├── Pages/
│   ├── Admin/
│   │   ├── Dashboard.vue           # Stats overview
│   │   ├── HotelProfiles/Index.vue # Manage profiles + image upload
│   │   ├── Rooms/Index.vue         # Manage rooms per profile
│   │   ├── SurveyLinks/Index.vue   # Manage survey links per profile
│   │   ├── SurveySections/Index.vue# Manage sections & questions (drag & drop)
│   │   ├── Users/Index.vue         # Manage admin users
│   │   └── Responses.vue           # View responses per link
│   ├── Auth/Login.vue              # Admin login
│   ├── Error/NotFound.vue          # 404 page
│   └── Survey/
│       ├── Show.vue                # Public survey form
│       └── Response.vue            # View submitted response
└── Utils/
    └── validators.js               # Vuelidate validators with EN/TH messages
```

## Database Schema

```
hotel_profiles
├── rooms (hotel_profile_id)
│   └── survey_links (room_id)
│       └── survey_responses (survey_link_id)
│           └── survey_answers (response_id, question_id)
└── survey_sections (hotel_profile_id)
    ├── survey_section_translations (section_id, locale)
    └── survey_questions (section_id)
        └── survey_question_translations (question_id, locale)
```

## Getting Started

### Docker (recommended)

```bash
docker compose up --build -d
```

เข้าใช้งาน:
- **Survey form:** http://localhost:8000/{locale}/{slug}
- **Admin panel:** http://localhost:8000/admin/login

Default admin: `admin` / `password`

### Manual Setup

```bash
composer install
npm install
cp .env.example .env
php artisan key:generate
php artisan migrate --seed
php artisan serve &
npm run dev
```

## Key Routes

| Route | Description |
|-------|-------------|
| `GET /{locale}/{slug}` | Public survey form |
| `POST /survey/submit` | Submit survey response |
| `GET /{locale}/{slug}/{number}` | View submitted response |
| `GET /admin/dashboard` | Admin dashboard |
| `GET /admin/hotel-profiles` | Manage hotel profiles |
| `GET /admin/rooms` | Manage rooms |
| `GET /admin/survey-sections` | Manage sections & questions |
| `GET /admin/survey-links` | Manage survey links |
| `GET /admin/users` | Manage users |
