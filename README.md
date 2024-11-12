## Getting Started

### Prerequisites

- Docker
- Docker Compose

### Installation

1. **Clone the repository**
2. **Copy the `.env.example` file to `.env`**
3. **Inside root of a project run small Docker container containing PHP and Composer to install the application's dependencies**
```
docker run --rm \
    -u "$(id -u):$(id -g)" \
    -v "$(pwd):/var/www/html" \
    -w /var/www/html \
    laravelsail/php83-composer:latest \
    composer install --ignore-platform-reqs
```
4. **Start Docker containers**
```
./vendor/bin/sail up
```
5. **Generate an application key**
```
./vendor/bin/sail artisan key:generate
```
6. **Run database migrations**
---

## EXAMPLE REQUEST
POST requests are protected by the csrf token 
### Create employee
Endpoint `employee/create` <br />
input: 
    
    'name': 'Employee'
    'last_name': 'Test'

Output:

    {
        "message": "Employee created successfully with uuid: 'employee_uuid'"
    }

### Work time register
Endpoint `working-time/register` <br />
input: 
    
    'employee_uuid': 'employee_uuid'
    'work_start': '2024-09-25 08:00'
    'work_end ': '2024-09-25 08:00'

Output:

    {
        message": "Time registered successfully"
    }


### Work time summary - daily
Endpoint `working-time/summary` <br />
input: 
    
    'employee_uuid': 'employee_uuid'
    'date': '2024-09-25'

Output:

    {
        "number of hours a given day": 8,
        "rate": "20 PLN",
        "total salary": 160
    }


### Work time summary - monthly
Endpoint `working-time/summary` <br />
input: 
    
    'employee_uuid': 'employee_uuid'
    'date': '2024-09'

Output:

    {
       "number of hours a given month": 42,
        "rate": "20 PLN",
        "the number of overtime hours in a given month": 2,
        "overtime rate": "40 PLN",
        "total salary": 880
    }