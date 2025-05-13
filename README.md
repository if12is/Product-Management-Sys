# Product Management System

A comprehensive product management system built with Laravel that includes both an admin dashboard for managing products and RESTful API endpoints for mobile and third-party applications.

## Features

### Admin Dashboard

-   Admin authentication (login/logout)
-   Admin dashboard That show analysis of products with charts
-   Product management:
    -   Create, edit, view, and delete products
    -   Product image upload and management
    -   Filtering and searching products
    -   Sorting by different fields
    -   Price range filtering
-   User-friendly interface for easy management

### RESTful API

-   Secure API with Sanctum authentication
-   Legacy API token support for backward compatibility
-   Endpoints for all product operations
-   Filtering, pagination, and search capabilities

## Requirements

-   PHP 8.x
-   Composer
-   Laravel 12
-   MySQL or compatible database

## Installation

1. Clone the repository
2. Run `composer install`
3. Run `npm install`

4. Copy `.env.example` to `.env` and configure your database
5. Edit `.env` file with your database credentials

```
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=PMS
DB_USERNAME=your_username
DB_PASSWORD=your_password
```

5. Run `php artisan key:generate`
6. Run `php artisan migrate --seed` // This will create a default admin user (admin@example.com / password123) and sample products
7. Run `php artisan storage:link` to create a symbolic link for file uploads
8. Run `php artisan serve` to start the development server
9. Run `npm run dev` to start the development server

## Admin Dashboard Usage

1. Access the admin panel at `/admin/login`
2. Login with the default admin credentials (or ones you've set up)
3. Manage products through the dashboard:
    - View all products on the main dashboard
    - Click "Add New Product" to create products
    - Use the filter options to search, sort, or filter by category/price
    - Click on a product to view details
    - Use the edit/delete buttons to modify products

## API Documentation

### Authentication Methods

#### Sanctum Authentication (Recommended)

1. Register a user:

    ```
    POST /api/register
    {
      "name": "Test User",
      "email": "user@example.com",
      "password": "password",
      "password_confirmation": "password"
    }
    ```

2. Login to get a token:

    ```
    POST /api/login
    {
      "email": "user@example.com",
      "password": "password"
    }
    ```

3. Use the token in subsequent requests:
    ```
    Authorization: Bearer {token}
    ```

#### Legacy API Token (For backward compatibility)

Use the hardcoded API token in the Authorization header:

```
Authorization: IF12I1234567890@#
```

### API Endpoints

#### Authentication

| Method | Endpoint        | Description                 | Auth Required |
| ------ | --------------- | --------------------------- | ------------- |
| POST   | `/api/login`    | Login and get an API token  | No            |
| GET    | `/api/user`     | Get authenticated user info | Yes (Sanctum) |
| POST   | `/api/logout`   | Logout and revoke token     | Yes (Sanctum) |

#### Products

| Method | Endpoint                                  | Description                         | Auth Required |
| ------ | ----------------------------------------- | ----------------------------------- | ------------- |
| GET    | `/api/products`                           | List all active products            | No            |
| GET    | `/api/products?paginate=true&per_page=10` | Get paginated products with filters | No            |
| GET    | `/api/products/{id}`                      | Get a specific product by ID        | No            |
| POST   | `/api/products`                           | Create a new product                | Yes           |
| PUT    | `/api/products/{id}`                      | Update an existing product          | Yes           |
| DELETE | `/api/products/{id}`                      | Delete a product                    | Yes           |

### Product Filtering

The `/api/products` endpoint supports the following query parameters:

| Parameter      | Description                   | Example                |
| -------------- | ----------------------------- | ---------------------- |
| paginate       | Enable pagination             | `paginate=true`        |
| per_page       | Number of items per page      | `per_page=15`          |
| category       | Filter by category            | `category=Electronics` |
| search         | Search term for name/category | `search=phone`         |
| min_price      | Minimum price filter          | `min_price=100`        |
| max_price      | Maximum price filter          | `max_price=1000`       |
| sort_by        | Sort field                    | `sort_by=price`        |
| sort_direction | Sort direction (asc/desc)     | `sort_direction=desc`  |

### Response Format

All API responses follow this standard format:

```json
{
  "success": true|false,
  "message": "Success or error message",
  "data": {
    // Response data
  }
}
```

For pagination, the response includes additional pagination metadata:

```json
{
  "success": true,
  "data": [...],
  "pagination": {
    "total": 100,
    "per_page": 10,
    "current_page": 1,
    "last_page": 10,
    "from": 1,
    "to": 10
  }
}
```

### Error Handling

The API returns appropriate HTTP status codes and error messages:

-   200: OK - Request successful
-   201: Created - Resource created successfully
-   401: Unauthorized - Invalid or missing authentication
-   404: Not Found - Resource not found
-   422: Unprocessable Entity - Validation error
-   500: Server Error - Something went wrong on the server

## Postman Collection

A Postman collection is included in the `postman_collection.json` file that contains all API endpoints with examples. You can import this file into Postman to quickly test the API.

## Postman API Documentation

A Postman API documentation is included in the 
`https://ahmed-9464583.postman.co/workspace/Ahmed's-Workspace~c43dcbc3-0fa1-494a-892f-64e670144e40/collection/44910971-8adc12e5-cb56-40ab-bd9d-533721937fbd?action=share&creator=44910971`


## Database Seeding

The project includes seeders to populate the database with sample data:

```
php artisan db:seed
```

This will:

1. Create a default admin user (admin@example.com / password123)
2. Generate sample products with random data

## License

This project is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
