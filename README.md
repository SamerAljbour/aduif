# ADUIF - Association des Diplômés de l'Université Française en Jordanie

A comprehensive multi-language web platform for managing a university alumni association, built with Laravel 11 and featuring both public-facing landing pages and a powerful admin dashboard.

## 🌟 Features

### Public Section (Landing Page)

- **Hero Section** - Eye-catching banner with organization branding and calls-to-action
- **About Club Section** - Organization information with multi-language support (Arabic, French, English)
- **Management Team** - Display of leadership and management members
- **Latest News** - Blog-style posts and announcements
- **Projects Showcase** - Featured projects with status tracking (coming soon, active, completed)
- **Join Us Section** - Membership application forms
- **Contact Form** - Direct communication channel
- **Responsive Design** - Optimized for mobile, tablet, and desktop

### Admin Dashboard

#### Analytics & Statistics

- **Total Members** - Count of all registered members
- **Approved Members** - Successfully verified member profiles
- **Active Projects** - Total projects in the system
- **Pending Join Requests** - Applications awaiting review

#### Data Visualizations

- **Recent Signups Graph** - Weekly member registration trends
- **Member Status Pie Chart** - Distribution of approved/pending/rejected members
- **Content Volume Bar Chart** - Comparative statistics across all content types
- **Real-Time Map** - Geographic member distribution visualization
- **Calendar Widget** - Date navigation and scheduling

#### Content Management

- **Latest Projects Table** - Project overview with status badges and dates
- **Member Management** - Track and manage member applications
- **News Management** - Create and publish announcements
- **Contact Management** - Handle inquiries and messages

### Authentication & Security

- **User Registration** - Secure signup with validation
- **Login/Logout** - Protected authentication system
- **Role-based Access** - Admin dashboard protection
- **Guest/Auth Middleware** - Conditional content display

## 🛠️ Technology Stack

- **Backend**: Laravel 11 (PHP 8.1+)
- **Database**: MySQL/PostgreSQL with Eloquent ORM
- **Frontend**: Bootstrap 5, Tailwind CSS
- **Charts**: Chart.js for data visualization
- **Icons**: Feather Icons
- **Maps**: jsVectorMap for geographic data
- **Internationalization**: Laravel's built-in translation system

## 📋 Prerequisites

- PHP 8.1 or higher
- Composer
- Node.js & NPM
- MySQL/PostgreSQL database
- Git

## 🚀 Installation

1. **Clone the repository**

    ```bash
    git clone <repository-url>
    cd aduif
    ```

2. **Install PHP dependencies**

    ```bash
    composer install
    ```

3. **Install Node.js dependencies**

    ```bash
    npm install
    ```

4. **Environment Configuration**

    ```bash
    cp .env.example .env
    ```

    Configure your database and other settings in `.env`

5. **Generate Application Key**

    ```bash
    php artisan key:generate
    ```

6. **Run Database Migrations**

    ```bash
    php artisan migrate
    ```

7. **Seed Database (Optional)**

    ```bash
    php artisan db:seed
    ```

8. **Build Assets**

    ```bash
    npm run build
    # or for development
    npm run dev
    ```

9. **Start the Development Server**
    ```bash
    php artisan serve
    ```

## 📁 Project Structure

```
aduif/
├── app/
│   ├── Http/Controllers/
│   │   ├── Admin/          # Admin controllers
│   │   └── Public/         # Public controllers
│   ├── Models/             # Eloquent models
│   └── Providers/
├── database/
│   ├── migrations/         # Database migrations
│   └── seeders/           # Database seeders
├── public/                 # Public assets
│   ├── admin/             # Admin panel assets
│   └── user/              # Public site assets
├── resources/
│   ├── css/               # Stylesheets
│   ├── js/                # JavaScript files
│   ├── lang/              # Translation files
│   └── views/             # Blade templates
│       ├── adminLayouts/  # Admin templates
│       ├── layouts/       # Public templates
│       └── dashboard/     # Dashboard views
├── routes/                 # Route definitions
│   ├── web.php           # Public routes
│   ├── auth.php          # Authentication routes
│   └── admin.php         # Admin routes
└── tests/                 # Test files
```

## 🗄️ Database Models

### Core Models

- **User** - Authentication and user management
- **Member** - Alumni member profiles with translations
- **Project** - Project management with multi-language support
- **Post** - News and blog posts
- **Management** - Leadership team information
- **JoinRequest** - Membership applications
- **Contact** - Contact form submissions

### Translation Models

- **MemberTranslation**
- **ProjectTranslation**
- **PostTranslation**
- **ManagementTranslation**
- **JoinRequestTranslation**
- **ContactTranslation**

## 🌐 Multi-Language Support

The platform supports three languages:

- **Arabic (ar)** - RTL support included
- **French (fr)** - Primary language
- **English (en)** - Default fallback

Language switching is available throughout the application with proper URL localization.

## 🎨 Customization

### Styling

- Public styles: `public/user/css/main.css`
- Admin styles: `public/admin/css/app.css`
- Responsive breakpoints configured for mobile-first design

### Charts & Visualizations

- Chart.js configurations in `resources/views/adminLayouts/app.blade.php`
- Dynamic data binding for real-time statistics
- Customizable color schemes and themes

## 🔧 Available Commands

```bash
# Clear cache
php artisan cache:clear
php artisan config:clear
php artisan route:clear
php artisan view:clear

# Run migrations
php artisan migrate

# Create new migration
php artisan make:migration create_table_name

# Create new model
php artisan make:model ModelName

# Create new controller
php artisan make:controller ControllerName

# Run tests
php artisan test
```

## 📊 Admin Dashboard Features

### Navigation

- Sidebar with active route highlighting
- Responsive collapse for mobile devices
- Quick access to all admin sections

### Analytics Cards

- Real-time member statistics
- Project status overview
- Join request management
- Content volume metrics

### Data Tables

- Sortable project listings
- Status-based filtering
- Date formatting and display
- Responsive table design

## 🔒 Security Features

- CSRF protection on all forms
- Input validation and sanitization
- Protected file uploads
- Role-based access control
- Secure authentication middleware

## 📱 Responsive Design

- Mobile-first approach
- Bootstrap 5 grid system
- Custom breakpoints for tablets and large screens
- Touch-friendly navigation
- Optimized performance across devices

## 🚀 Deployment

1. **Environment Setup**
    - Configure production `.env` file
    - Set up database credentials
    - Configure mail settings

2. **Asset Compilation**

    ```bash
    npm run build
    ```

3. **Database Migration**

    ```bash
    php artisan migrate --force
    ```

4. **Cache Optimization**
    ```bash
    php artisan config:cache
    php artisan route:cache
    php artisan view:cache
    ```

## 🤝 Contributing

1. Fork the repository
2. Create a feature branch (`git checkout -b feature/amazing-feature`)
3. Commit your changes (`git commit -m 'Add amazing feature'`)
4. Push to the branch (`git push origin feature/amazing-feature`)
5. Open a Pull Request

## 📝 License

This project is licensed under the MIT License - see the [LICENSE](LICENSE) file for details.

## 📞 Support

For support and questions:

- Create an issue in the repository
- Contact the development team
- Check the documentation for common solutions

## 🔄 Future Enhancements

- [ ] Email notification system for join requests
- [ ] Advanced search and filtering
- [ ] API endpoints for mobile app integration
- [ ] Event management system
- [ ] Payment integration for memberships
- [ ] Advanced analytics and reporting
- [ ] Social media integration
- [ ] Newsletter system

---

**Built with ❤️ for the Association des Diplômés de l'Université Française en Jordanie**
