# Route Documentation

## Public Routes
- `GET /` - Homepage showing active campaigns
- `GET /campaigns` - List all active campaigns
- `GET /campaigns/{slug}` - Show campaign details

## Authentication Routes
- `GET /login` - Show login form (guest only)
- `POST /login` - Process login
- `POST /logout` - Process logout
- `GET /register` - Show registration form (guest only)
- `POST /register` - Process registration

## Admin Routes
All routes prefixed with `/admin` and require `auth`, `verified`, `role:admin` middleware

### Dashboard
- `GET /` - Admin dashboard overview
- `GET /statistics` - View system statistics

### User Management
- `GET /users` - List all users
- `POST /users` - Create new user
- `GET /users/create` - Show user creation form
- `GET /users/{user}` - Show user details
- `PUT /users/{user}` - Update user
- `DELETE /users/{user}` - Delete user

### Campaign Management
- `GET /campaigns` - List all campaigns
- `GET /campaigns/{campaign}` - Show campaign details
- `PUT /campaigns/{campaign}/status` - Update campaign status
- `DELETE /campaigns/{campaign}` - Delete campaign

### Category Management
- `GET /categories` - List all categories
- `POST /categories` - Create new category
- `PUT /categories/{category}` - Update category
- `DELETE /categories/{category}` - Delete category

### Feedback Management
- `GET /feedback` - List all feedback
- `GET /feedback/{feedback}` - Show feedback details
- `DELETE /feedback/{feedback}` - Delete feedback

## Fundraiser Routes
All routes prefixed with `/fundraiser` and require `auth`, `verified`, `role:fundraiser` middleware

### Campaign Management
- `GET /campaigns` - List fundraiser's campaigns
- `GET /campaigns/create` - Show campaign creation form
- `POST /campaigns` - Create new campaign
- `GET /campaigns/{campaign}/edit` - Show campaign edit form
- `PUT /campaigns/{campaign}` - Update campaign

### Donation Management
- `GET /donations/{campaign}` - View donations for a campaign
- `POST /campaigns/{campaign}/withdraw` - Process withdrawal request
- `POST /campaigns/{campaign}/updates` - Add campaign update

## Donor Routes
Requires `auth`, `verified` middleware

### Profile
- `GET /profile` - Show profile edit form
- `PUT /profile` - Update profile

### Donation
- `POST /campaigns/{campaign}/donate` - Make donation
- `GET /donations` - View donation history
- `POST /campaigns/{campaign}/comments` - Add comment
- `POST /feedback` - Submit feedback
