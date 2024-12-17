# Product Service

The **Product Service** is a Symfony-based microservice that manages product details, including stock quantities and income tracking. It supports creating and listing products while integrating seamlessly with the **Order Service** to handle product stock and income updates asynchronously using RabbitMQ.

---

## Features

- **Create and list products**.
- **Manage stock quantities**.
- **Track product income** after orders are placed.
- **Expose RESTful APIs** for external service integration.
- **Asynchronous income updates** via RabbitMQ.

---

## Requirements

- **PHP 8.3+**
- **Symfony CLI**
- **Composer**
- **PostgreSQL** for the database.

---

## Setup

Follow these steps to set up the **Product Service** locally:

### 1. Clone the Repository

Clone the Product Service repository:

```bash
git clone https://github.com/azaykarimli/products.git
cd products


```

### 2. Install Dependencies


```bash

composer install

```


### 3. Configure Environment ### update it according to your db url configiration
```bash

# Database Configuration
DATABASE_URL="postgresql://products_user:password@127.0.0.1:5432/products_db?serverVersion=15&charset=utf8"

# RabbitMQ Configuration
MESSENGER_TRANSPORT_DSN=amqp://guest:guest@127.0.0.1:5672/%2f


```

### 4. Set Up the Database

```bash

php bin/console doctrine:database:create
php bin/console doctrine:migrations:migrate



```

### 5. Start the Symfony Server

```bash

symfony server:start --port=8001



```

### 6.Endpoints

## POST /products
Description: Create a new product.

Request:

json
Copy code
{
  "name": "New Brand Product",
  "price": 99.99,
  "qty": 100
}
Response:


{
  "id": "9100dd46-b1ef-479d-af0b-e226a399c8cd",
  "name": "New Brand Product",
  "qty": 100,
  "price": 99.99,
  "income": 0
}

## GET /orders
GET /products
Description: List all products.

Response:


{
  "data": [
    {
      "id": "9100dd46-b1ef-479d-af0b-e226a399c8cd",
      "name": "New Brand Product",
      "qty": 100,
      "price": 99.99,
      "income": 0
    }
  ]
}


### Dummy Data with Fixtures
You can load sample data into the database using Symfony's fixtures.

File: src/DataFixtures/ProductFixtures.php

```bash

php bin/console doctrine:fixtures:load

```


### Documentation for Developers
Product Entity: Located in src/Entity/Product.php.
Fixtures: Sample product data for testing in src/DataFixtures/ProductFixtures.php.
Endpoints: Defined using Symfony's API Platform.




Project Structure

product-service/
├── src/
│   ├── Controller/        # Controllers for handling requests
│   ├── Entity/            # Doctrine entity for products
│   ├── DataFixtures/      # Fixtures for loading sample data
│   └── Repository/        # Doctrine repository for products
├── config/
│   ├── packages/          # Symfony configuration files
│   └── messenger.yaml     # RabbitMQ Messenger configuration
├── migrations/            # Database migrations
├── .env                   # Environment configuration
├── composer.json          # Composer dependencies
└── README.md              # This documentation



### Notes
The Order Service communicates with this service via HTTP API to manage stock and income updates.

Product endpoints are accessible at:
http://127.0.0.1:8001/api/products.


