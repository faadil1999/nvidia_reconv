# Professional Career Transition Platform(RECONVERTO)

## Project Overview

This platform provides a tailored approach to help individuals transition smoothly into new careers, leveraging their past experiences and acquired skills. Designed with a modern tech stack, it combines Laravel and Vue.js with Tailwind CSS on the frontend, and integrates Python with FastAPI on the backend to offer a seamless user experience. Utilizing advanced NVIDIA tools, it assesses career history and generates personalized skill-building pathways for effective and guided professional reconversion.

### Key Features

- **Personalized Transition Pathways**: Using NVIDIA technology, the platform analyzes past career data to recommend relevant skills and courses for transitioning into new roles.
- **Step-by-Step Learning Journeys**: Each career pathway is broken into steps, each offering focused resources, key skills, and actionable tasks to progress efficiently.
- **Data-Driven Recommendations**: Leveraging machine learning and historical data, the platform continuously adapts recommendations based on evolving job market demands.
- **Seamless Integration of Python and Laravel**: A robust architecture that combines FastAPI’s performance with Laravel’s extensive features for a comprehensive development experience.

### Technologies Used

- **Frontend**: Vue.js, Tailwind CSS
- **Backend**: Laravel, FastAPI
- **Python**: Integrated with OpenAI, NVIDIA for data processing(NVIDIA NIM Microservices)
- **DevOps**: Docker, Composer, npm
- **Database**: Configurable for various database systems (e.g., MySQL, SQLite)
  
### Prerequisites

- PHP >= 8.2
- Node.js >= 16
- Composer
- Python 3.x
- Docker (optional, for containerized environment)
---

## Table of Contents

- [Installation](#installation)
- [Environment Variables](#environment-variables)
- [Running the Application](#running-the-application)

---

## Installation

This project requires **PHP ^8.2**, **Composer**, **Node.js**, and **Python ^3.**. Follow these steps to set up and install dependencies:

### Step 1: Clone the Repository

```bash
git clone <repository_url>
cd <repository_folder>
```
### Step 2: Install Dependencies 

**PHP/Laravel**
Use Composer to install Laravel dependencies:

```bash
composer install
```
**Node.js**
Install JavaScript dependencies with npm:

```bash
npm install
```
**Python FastAPI**
It’s recommended to create a virtual environment for Python dependencies:
run inside ..\pythonNVIDIA_NIM folder
```bash
python3 -m venv env
source env/bin/activate  # For Linux/macOS
env\Scripts\activate or  .\venv\Scripts\activate     # For Windows
```

Install packages from requirements.txt:

```bash
pip install -r requirements.txt
```

## Environment Variables

1. **Copy the Example Environment File**

   To set up your environment variables, copy the `.env.example` file to `.env`:

   ```bash
   cp .env.example .env
   ```
2. **Generate an Application Key**

This step is essential for the security of your Laravel application. Generate a new application key with:

```bash
php artisan key:generate
```
3. **Configure Database**

    Open the .env file.

    Update the DB_CONNECTION, DB_HOST, DB_PORT, DB_DATABASE, DB_USERNAME, and DB_PASSWORD fields to match your database configuration.

    If you’re using SQLite for development, you can set up the database by running:

```bash
touch database/database.sqlite
```
4. **Configure Python and FastAPI Environment**

    In the .env file, add any required environment variables for FastAPI.

```bash
PYTHON_API_URL=python_api_url(generally: http://127.0.0.1:8000)
NVIDIA_API_KEY=your_openai_key_here
```

### Running the Application

Development Mode

To start the application in development mode:

Laravel (PHP):
```bash
php artisan serve
```
Frontend (Node.js + Vite):
```bash
npm run dev
```
Backend (Python + FastAPI):
Locate your terminal inside ..\pythonNVIDIA_NIM then run
```bash
 python -m uvicorn app.main:app --reload
```
