# Hire Jeffrey - Craft CMS Portfolio

[![Craft CMS](https://img.shields.io/badge/Craft%20CMS-5.6.17-blue.svg)](https://craftcms.com/)
[![PHP](https://img.shields.io/badge/PHP-8.2+-purple.svg)](https://php.net/)
[![Tailwind CSS](https://img.shields.io/badge/Tailwind%20CSS-3.4+-38B2AC.svg)](https://tailwindcss.com/)
[![Vite](https://img.shields.io/badge/Vite-5.4+-646CFF.svg)](https://vitejs.dev/)

A modern, performance-driven portfolio website built with Craft CMS 5, featuring a clean design, optimized user experience, and scalable architecture. This project showcases full-stack web development expertise with a focus on accessibility, performance, and maintainable code.

🌐 **Live Site**: [https://hirejeffrey.com/](https://hirejeffrey.com/)

## 🚀 Features

- **Modern Tech Stack**: Craft CMS 5 with PHP 8.2+, Tailwind CSS, and Vite
- **Performance Optimized**: Fast loading times with optimized assets and caching
- **Responsive Design**: Mobile-first approach with Tailwind CSS
- **Accessibility Focused**: WCAG compliant with semantic HTML and ARIA labels
- **SEO Optimized**: Structured data, meta tags, and sitemap generation
- **Contact Forms**: Freeform integration for lead generation
- **Blog System**: Content management for articles and projects
- **Cloud Integration**: AWS S3 for asset storage and CDN delivery
- **Development Workflow**: Hot reloading with Vite and DDEV integration

## 🛠 Tech Stack

### Backend
- **Craft CMS 5.6.17** - Content management system
- **PHP 8.2+** - Server-side language
- **MySQL/PostgreSQL** - Database
- **AWS S3** - Asset storage and CDN

### Frontend
- **Tailwind CSS 3.4+** - Utility-first CSS framework
- **Vite 5.4+** - Build tool and dev server
- **JavaScript (ES6+)** - Client-side functionality
- **Twig** - Template engine

### Development Tools
- **DDEV** - Local development environment
- **Composer** - PHP dependency management
- **npm** - Node.js package management
- **Git** - Version control

### Key Plugins
- **Element API** - REST API endpoints
- **Freeform** - Form handling
- **CKEditor** - Rich text editing
- **Feed Me** - Content import/export
- **Craft Cookies** - Cookie management
- **SendGrid** - Email delivery

## 📋 Prerequisites

Before you begin, ensure you have the following installed:

- **PHP 8.2+** with required extensions
- **Composer** 2.0+
- **Node.js** 18+ and npm
- **DDEV** (recommended) or local web server
- **MySQL 8.0+** or **PostgreSQL 13+**

## 🚀 Quick Start

### 1. Clone the Repository

```bash
git clone https://github.com/JeffreyBenusa/hire-jeffrey-craft.git
cd hire-jeffrey-craft
```

### 2. Install Dependencies

```bash
# Install PHP dependencies
composer install

# Install Node.js dependencies
npm install
```

### 3. Environment Setup

```bash
# Copy environment file
cp .env.example.dev .env

# Edit .env with your database and site settings
# Required variables:
# - DB_DSN
# - CRAFT_SECURITY_KEY
# - CRAFT_SITE_URL
# - AWS_ACCESS_KEY_ID (for S3)
# - AWS_SECRET_ACCESS_KEY (for S3)
# - AWS_BUCKET (for S3)
```

### 4. Database Setup

```bash
# Run Craft CMS setup
./craft setup

# Or manually create database and run migrations
./craft migrate/all
./craft project-config/apply
```

### 5. Build Assets

```bash
# Development
npm run dev

# Production
npm run build
```

### 6. Start Development Server

```bash
# Using DDEV (recommended)
ddev start
ddev npm run ddev-dev

# Or using local server
php -S localhost:8000 -t web
```

## 🏗 Project Structure

```
hire-jeffrey-craft/
├── config/                 # Craft CMS configuration
│   ├── app.php            # Application config
│   ├── general.php        # General settings
│   └── project/           # Project config files
├── modules/
│   └── hire-jeffrey/      # Custom module
├── src/                   # Frontend source files
│   ├── css/              # Stylesheets
│   ├── js/               # JavaScript files
│   └── img/              # Images and assets
├── templates/             # Twig templates
│   ├── _layouts/         # Base layouts
│   ├── _partials/        # Reusable components
│   ├── homepage/         # Homepage templates
│   ├── projects/         # Project templates
│   └── blog/             # Blog templates
├── web/                  # Web root
└── storage/              # Craft storage
```

## 🎨 Customization

### Styling
The project uses Tailwind CSS with custom color palette defined in `tailwind.config.js`:

- **Primary**: Blue (#1E3A8A)
- **Teal**: Brand color (#13a394)
- **Accent**: Orange (#F97316)
- **Navy**: Dark theme (#0F172A)

### Templates
Templates are organized by section with reusable partials:
- `_layouts/base.twig` - Main layout template
- `_partials/` - Reusable components
- Section-specific templates in their respective folders

### Content Types
The site includes several content types:
- **Homepage** - Landing page with hero and services
- **Projects** - Portfolio showcase
- **Blog** - Articles and insights
- **About Me** - Professional background
- **Contact** - Lead generation forms

## 🔧 Development

### Available Scripts

```bash
# Development with hot reload
npm run dev

# Production build
npm run build

# DDEV development
npm run ddev-dev
```

### Code Style
- **PHP**: PSR-12 coding standards
- **JavaScript**: ES6+ with modern syntax
- **CSS**: Tailwind utility classes
- **Twig**: Craft CMS best practices

### Database Migrations
```bash
# Apply project config changes
./craft project-config/apply

# Run migrations
./craft migrate/all

# Backup database
./craft db/backup
```

## 🚀 Deployment

### Production Checklist
- [ ] Set `CRAFT_ENVIRONMENT=production` in `.env`
- [ ] Generate production assets: `npm run build`
- [ ] Set up database backups
- [ ] Configure AWS S3 credentials
- [ ] Set up SSL certificate
- [ ] Configure web server (Apache/Nginx)
- [ ] Set proper file permissions

### Environment Variables
Required production environment variables:
```env
CRAFT_ENVIRONMENT=production
CRAFT_SITE_URL=https://hirejeffrey.com
DB_DSN=mysql:host=localhost;dbname=your_db
CRAFT_SECURITY_KEY=your-security-key
AWS_ACCESS_KEY_ID=your-aws-key
AWS_SECRET_ACCESS_KEY=your-aws-secret
AWS_BUCKET=your-s3-bucket
```

## 🤝 Contributing

1. Fork the repository
2. Create a feature branch (`git checkout -b feature/amazing-feature`)
3. Commit your changes (`git commit -m 'Add amazing feature'`)
4. Push to the branch (`git push origin feature/amazing-feature`)
5. Open a Pull Request

## 📄 License

This project is private and proprietary. All rights reserved.

## 👨‍💻 Author

**Jeffrey Benusa**
- Website: [https://hirejeffrey.com/](https://hirejeffrey.com/)
- GitHub: [@JeffreyBenusa](https://github.com/JeffreyBenusa)

## 🙏 Acknowledgments

- [Craft CMS](https://craftcms.com/) - The amazing content management system
- [Tailwind CSS](https://tailwindcss.com/) - Utility-first CSS framework
- [Vite](https://vitejs.dev/) - Next generation frontend tooling
- [DDEV](https://ddev.com/) - Local development environment

---

Built with ❤️ using Craft CMS and modern web technologies.
