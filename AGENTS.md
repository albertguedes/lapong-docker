# AGENTS.md

This file provides guidelines for AI agents working on this codebase.

## Build Commands

```bash
# PHP/Laravel
composer test                      # Run all PHPUnit tests
vendor/bin/phpunit --filter=ClassName    # Run single test class
vendor/bin/phpunit --filter=testMethod   # Run single test
composer pint                      # Format PHP code (PSR-12)
vendor/bin/phpstan analyze         # Static analysis (level 5)

# JavaScript/Frontend
npm run dev                        # Vite development server
npm run build                      # Production build
eslint resources/js/**             # Lint JavaScript

# Docker Commands (Dockli)
dockli art <args>                  # Run Artisan commands
dockli comp <args>                 # Run Composer commands
dockli php <args>                  # Run PHP commands
dockli node <args>                 # Run Node.js commands
dockli npm <args>                  # Run npm commands
dockli mysql <args>                # Run MySQL client
dockli psql <args>                 # Run PostgreSQL client
dockli sh                          # Interactive shell
dockli test                        # Run PHPUnit
dockli lint                        # Run all linters
dockli fresh                       # Clear cache, migrate, seed
dockli logs -f                     # Follow container logs
dockli status                      # Container status
dockli restart                     # Restart containers
dockli stop                        # Stop containers
```

## Code Style Guidelines

### PHP (PSR Standards)
- PSR-1: Basic coding standard
- PSR-2: Coding style guide
- PSR-4: Autoloading (App\\ namespace)
- PSR-12: Extended coding style
- Use strict types: `declare(strict_types=1);`
- Return type hints on all methods
- Typed properties for classes

### JavaScript (ECMAScript)
- ES2022+ syntax
- ES Modules (import/export)
- jQuery for DOM manipulation (no frameworks)
- No legacy IE support
- const/let over var
- Arrow functions where appropriate

### CSS
- TailwindCSS 4 conventions
- Bootstrap 5 grid system
- FontAwesome 6 icons
- No custom CSS unless necessary (use Tailwind)

## Project Structure

```
app/
├── Actions/               # Business logic (Laravel Actions pattern)
│   └── Fortify/          # Authentication actions
├── Http/
│   ├── Controllers/      # Route handlers
│   └── Requests/         # Form request validation
├── Models/               # Eloquent models
├── Policies/             # Authorization policies
├── Providers/            # Service providers
└── View/Components/      # Blade components (x-namespaced)

database/
├── factories/            # Model factories
└── seeders/              # Database seeders

routes/
├── api.php              # API routes
├── web.php              # Web routes
└── *.php                # Domain-specific routes

tests/
├── Unit/                # Unit tests
└── Feature/             # Feature tests

lang/
├── en/                  # English translations
└── pt_BR/               # Portuguese translations
```

## Naming Conventions

| Element | Convention | Example |
|---------|------------|---------|
| Classes | PascalCase | `UserController` |
| Methods/Variables | camelCase | `$userName` |
| Constants | UPPER_SNAKE_CASE | `MAX_RETRY_COUNT` |
| Database Tables | snake_case | `customer_contacts` |
| Foreign Keys | snake_case | `customer_id` |
| Routes | kebab-case | `customer.profile` |
| Views | kebab-case | `customer/profile/index` |
| Translation Keys | snake_case | `messages.login` |

## Error Handling

- Use Laravel exceptions (`ValidationException`, `AuthenticationException`)
- Log with context using `Logger::info()` with context array
- Never expose sensitive data in error responses
- User-facing messages in translation files (`lang/pt_BR/messages.php`)
- Always wrap database operations in transactions when modifying data

## Testing

- PHPUnit 11
- Feature tests for HTTP assertions
- Unit tests for business logic
- Use factories for test data: `User::factory()->create()`
- SQLite in-memory for fast tests
- Never commit test database modifications

## Internationalization

- **Backend**: English only (code, comments, logs)
- **User-facing**: `__('messages.key')` in Blade templates
- **JavaScript**: `i18n(key)` function
- **Translation keys**: Always in English (`messages.login`, not `messages.entrar`)
- **Fallback**: English when translation missing

## Common Patterns

### Form Request Validation
```php
use Illuminate\Foundation\Http\FormRequest;

class StoreUserRequest extends FormRequest
{
    public function authorize(): bool
    {
        return $this->user()->can('create users');
    }

    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'unique:users'],
        ];
    }
}
```

### Blade Component
```blade
<x-layouts.main>
    <div class="card">
        <h1>{{ __('messages.welcome') }}</h1>
    </div>
</x-layouts.main>
```

### Action Class
```php
class CreateUser implements CreatesNewUsers
{
    public function create(array $input): User
    {
        // Validation and creation logic
    }
}
```

## Docker Environment

- PHP-FPM container for application code
- Nginx container for web server
- PostgreSQL container for database
- All containers use Alpine Linux
- Use `dockli` script for container commands
