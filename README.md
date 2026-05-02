<div align="center">

# 🚀 Jarreva Creative
**"Stop Wasting Opportunities. Start Building Systems."**

A premium Laravel web application and lead-generation platform designed to help high-performers, particularly Gen Z, overcome mental burnout, build unbreakable discipline, and transform their potential into real impact.

[![Laravel](https://img.shields.io/badge/Laravel-12.x-FF2D20?style=for-the-badge&logo=laravel&logoColor=white)](https://laravel.com)
[![PHP](https://img.shields.io/badge/PHP-8.2+-777BB4?style=for-the-badge&logo=php&logoColor=white)](https://php.net)
[![Tailwind CSS](https://img.shields.io/badge/Tailwind_CSS-38B2AC?style=for-the-badge&logo=tailwind-css&logoColor=white)](https://tailwindcss.com/)
[![License](https://img.shields.io/badge/License-MIT-blue.svg?style=for-the-badge)](https://opensource.org/licenses/MIT)

[View Demo](#) · [Report Bug](#) · [Request Feature](#)

</div>

---

## 🌟 About The Project

**Jarreva Creative** is more than just a landing page; it's a comprehensive funnel and catalog platform. The core philosophy of the site addresses a modern epidemic: *knowing exactly what to do, but lacking the discipline and focus to execute it.* 

Instead of relying on fleeting motivation, this platform offers a "library" of resources (books, guides, methodologies) aimed at forging lasting habits, reclaiming deep focus, and becoming distraction-proof.

### 🎯 Key Features

- **High-Converting Landing Pages**: Premium, modern, and dark-themed UI featuring custom 3D animations, gradient text, and dynamic scroll effects to captivate visitors.
- **Lead Capture System (Evolve)**: Integrated funnel for capturing leads seamlessly.
- **Digital Catalog / Library**: A showcase of premium digital products and books (e.g., "Build Unbreakable Discipline", "Reclaim Deep Focus").
- **Custom Admin Dashboard**: Fully authenticated administrative panel to manage:
  - Digital Books / Products Catalog
  - Admin Users
  - Site Settings & Configurations
  - Activity Logs & Support

---

## 💻 Tech Stack

- **Backend**: [Laravel 12.x](https://laravel.com/) (PHP 8.2+)
- **Frontend**: Blade Templating, [Tailwind CSS](https://tailwindcss.com/), Vanilla JavaScript (Custom Animations)
- **Database**: MySQL / SQLite (via Eloquent ORM)
- **Tooling**: Vite for fast frontend asset compilation.

---

## 🚀 Getting Started

Follow these steps to set up the project locally on your machine.

### Prerequisites

- PHP >= 8.2
- Composer
- Node.js & npm
- MySQL or SQLite

### Installation

1. **Clone the repository** (if applicable):
   ```bash
   git clone https://github.com/your-username/jarreva-creative.git
   cd jarreva-creative
   ```

2. **Install PHP dependencies**:
   ```bash
   composer install
   ```

3. **Install NPM dependencies**:
   ```bash
   npm install
   ```

4. **Environment Setup**:
   Copy the example `.env` file and generate the application key.
   ```bash
   cp .env.example .env
   php artisan key:generate
   ```
   *Note: Make sure to configure your database settings in the `.env` file.*

5. **Run Database Migrations**:
   ```bash
   php artisan migrate
   ```

6. **Compile Frontend Assets**:
   ```bash
   npm run dev
   ```

7. **Serve the Application**:
   ```bash
   php artisan serve
   ```
   *Your app will be available at `http://localhost:8000`*

---

## 📂 Project Structure

- `app/Http/Controllers/Public/` - Controllers for the public-facing pages (Home, About, Contact, Catalog).
- `app/Http/Controllers/Admin/` - Controllers for the authenticated admin dashboard and management.
- `resources/views/public/` - Blade templates for the main website frontend.
- `resources/views/admin/` - Blade templates for the backend dashboard.
- `routes/web.php` - Routing configurations separating public, guest admin, and authenticated admin routes.

---

## ✨ Design Philosophy

The UI is built with a focus on a **premium, atmospheric experience**. It heavily utilizes:
- **Glassmorphism** and blur effects (`backdrop-blur`).
- **Dynamic Micro-animations** (pulse, float, trace, gradient shifts).
- A bespoke **System Intelligence** theme (e.g., typing effects, terminal-like status indicators).
- **Dark Mode First**: Optimized for a sleek dark-mode aesthetic with vibrant orange and blue accents (`#F97316` and `#137FEC`).

---

## 🤝 Contributing

Contributions, issues, and feature requests are welcome!
Feel free to check [issues page](#).

1. Fork the Project
2. Create your Feature Branch (`git checkout -b feature/AmazingFeature`)
3. Commit your Changes (`git commit -m 'Add some AmazingFeature'`)
4. Push to the Branch (`git push origin feature/AmazingFeature`)
5. Open a Pull Request

---

## 📝 License

Distributed under the MIT License. See `LICENSE` for more information.

<div align="center">
  <p>Built with 💻 and ☕ by <b>Jarreva Creative</b></p>
</div>
