# Carmasy - Modern Laravel Dashboard

[![Laravel](https://img.shields.io/badge/Laravel-12.47.0-red.svg)](https://laravel.com)
[![Livewire](https://img.shields.io/badge/Livewire-4.0.1-orange.svg)](https://livewire.laravel.com)
[![TailwindCSS](https://img.shields.io/badge/Tailwind_CSS-4.1-blue.svg)](https://tailwindcss.com)
[![License: MIT](https://img.shields.io/badge/License-MIT-yellow.svg)](https://opensource.org/licenses/MIT)

A modern, high-performance dashboard built with the latest versions of Laravel 12, Livewire v4, and Tailwind CSS v4. Features blazing-fast performance with the new Livewire Blaze compiler and CSS-first Tailwind configuration.

## ✨ Features

### 🚀 Performance Optimized
- **Laravel 12.47.0** - Latest framework with modern architecture
- **Livewire v4.0.1** - 20x performance boost with Blaze compiler
- **Tailwind CSS v4.1** - 5x faster builds with CSS-first configuration
- **Production-ready optimization** - Asset chunking, critical CSS splitting

### 🎨 Modern UI/UX
- **Dark/Light Mode** - Automatic theme switching
- **Responsive Design** - Mobile-first approach
- **Interactive Components** - Real-time counter, forms, notifications
- **Smooth Animations** - CSS transitions and effects

### 🛠️ Developer Experience
- **Hot Reload** - Instant development feedback
- **Type Safety** - PHP 8.3+ with proper type hints
- **Modern Testing** - Pest framework integration
- **Production Deployment** - Complete deployment script

## 🏗️ Tech Stack

| Technology | Version | Purpose |
|------------|---------|---------|
| **Laravel** | 12.47.0 | PHP Framework |
| **Livewire** | 4.0.1 | Reactive Components |
| **Tailwind CSS** | 4.1 | Utility-first CSS |
| **Vite** | 7.3.1 | Asset Bundling |
| **PHP** | 8.3+ | Server-side Language |
| **Pest** | 4.3.1 | Testing Framework |

## 📦 Installation

### Prerequisites
- PHP 8.3 or higher
- Composer
- Node.js 18+ & npm
- Git

### Quick Start

1. **Clone the repository**
   ```bash
   git clone https://github.com/rogerlauermann/carmasy.git
   cd carmasy
   ```

2. **Install PHP dependencies**
   ```bash
   composer install
   ```

3. **Install Node dependencies**
   ```bash
   npm install
   ```

4. **Environment setup**
   ```bash
   cp .env.example .env
   php artisan key:generate
   ```

5. **Build assets**
   ```bash
   npm run build
   ```

6. **Start development servers**
   ```bash
   # Terminal 1: Laravel server
   php artisan serve

   # Terminal 2: Vite dev server
   npm run dev
   ```

7. **Visit the application**
   Open [http://localhost:8000](http://localhost:8000) in your browser

## 🚀 Production Deployment

### Automated Deployment

Use the included deployment script for production:

```bash
chmod +x deploy-production.sh
./deploy-production.sh
```

### Manual Deployment

1. **Configure production environment**
   ```bash
   cp .env.production .env
   php artisan key:generate --force
   ```

2. **Optimize for production**
   ```bash
   php artisan config:cache
   php artisan route:cache
   php artisan view:cache
   composer install --no-dev --optimize-autoloader
   ```

3. **Build optimized assets**
   ```bash
   npm run build
   ```

## 🎯 Key Components

### Dashboard Features
- **Interactive Counter** - Livewire reactive counter with increment/decrement
- **User Registration Form** - Validation with real-time feedback
- **Notification System** - Dismissible alerts with different types
- **Dark Mode Toggle** - Seamless theme switching
- **Technology Showcase** - Display of current tech stack versions

### Performance Features
- **Critical CSS** - Above-the-fold styles loaded first
- **Asset Chunking** - Optimized bundle splitting
- **Lazy Loading** - Efficient resource loading
- **Caching Strategy** - Redis-based caching configuration

## 🧪 Testing

Run the test suite:

```bash
# Run all tests
php artisan test

# Run with coverage
php artisan test --coverage
```

## 📁 Project Structure

```
carmasy/
├── app/                    # Laravel application code
├── resources/              # Views, assets, and language files
│   ├── css/               # Stylesheets (app.css, critical.css)
│   ├── js/                # JavaScript files
│   └── views/             # Blade templates
│       ├── layouts/       # Layout files
│       └── components/    # Livewire components
├── routes/                 # Route definitions
├── database/               # Migrations, seeders, factories
├── public/                 # Public assets and entry point
├── tests/                  # Test files
├── config/                 # Configuration files
├── storage/                # File storage
├── bootstrap/              # Application bootstrap
├── vendor/                 # Composer dependencies
├── node_modules/           # NPM dependencies
├── .env.example           # Environment template
├── .env.production        # Production environment
├── deploy-production.sh   # Deployment script
├── vite.config.js         # Vite configuration
├── composer.json          # PHP dependencies
├── package.json           # Node dependencies
└── README.md             # This file
```

## 🎨 Customization

### Styling
- Modify `resources/css/app.css` for global styles
- Update `resources/css/critical.css` for critical path styles
- Customize Tailwind configuration in `vite.config.js`

### Components
- Edit `resources/views/components/⚡welcome-dashboard.blade.php`
- Add new Livewire components with `php artisan make:livewire`

### Configuration
- Laravel config: `config/` directory
- Environment variables: `.env` file
- Vite config: `vite.config.js`

## 🤝 Contributing

1. Fork the repository
2. Create a feature branch (`git checkout -b feature/amazing-feature`)
3. Commit your changes (`git commit -m 'Add amazing feature'`)
4. Push to the branch (`git push origin feature/amazing-feature`)
5. Open a Pull Request

## 📄 License

This project is licensed under the MIT License - see the [LICENSE](LICENSE) file for details.

## 🙏 Acknowledgments

- [Laravel](https://laravel.com) - The PHP framework for web artisans
- [Livewire](https://livewire.laravel.com) - A full-stack framework for Laravel
- [Tailwind CSS](https://tailwindcss.com) - A utility-first CSS framework
- [Flux UI](https://fluxui.dev) - Official Livewire component library

## 📞 Support

If you have any questions or need help, please open an issue on GitHub.

---

**Built with ❤️ using the latest Laravel stack (January 2026)**
