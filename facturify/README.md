# Facturify – Prueba Técnica MID Fullstack (PHP/Python + React TS)

Este proyecto implementa una calculadora de órdenes con:

- Backend: Laravel 11 (API REST para calcular la orden).
- Frontend: React + TypeScript (Vite).
- Base de datos: MySQL en Docker, con Adminer para inspeccionar la BD.

## 1. Requisitos previos

Antes de empezar, necesitas tener instalado:

- Docker Desktop
- PHP 8.x
- Composer
- Node.js 18+ (incluye npm)
- Git

## 2. Estructura del proyecto

facturify/
├── backend/
├── frontend/
└── docker-compose.yml

## 3. Levantar la base de datos con Docker

En la raíz del proyecto:

docker-compose up -d

Esto levanta MySQL en el puerto 3308 y Adminer en http://localhost:8082.

### Datos de conexión para Adminer

System: MySQL  
Server: mysql-orders  
User: laravel  
Password: secret  
Database: orders_api

## 4. Backend – Laravel

cd backend
composer install

cp .env.example .env

Configurar .env:

DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3308
DB_DATABASE=orders_api
DB_USERNAME=laravel
DB_PASSWORD=secret

php artisan key:generate  
php artisan migrate --seed  
php artisan serve --host=127.0.0.1 --port=8000

## 5. Frontend – React + TypeScript

cd frontend  
npm install

Crear archivo .env:

VITE_API_BASE_URL=http://127.0.0.1:8000/api

npm run dev

Frontend disponible en http://localhost:5173.

## 6. Flujo completo

git clone <repo>
cd facturify

docker-compose up -d

cd backend
cp .env.example .env
composer install
php artisan key:generate
php artisan migrate --seed
php artisan serve

cd ../frontend
npm install
npm run dev

## 7. Arquitectura del código

Backend: rutas en routes/api.php y lógica en OrderController.  
Frontend: componentes React y hook useOrdersApi.

## 8. Problemas comunes

- Error de BD: verificar puerto 3308 y que Docker esté corriendo.
- Error en frontend: revisar que backend esté en 127.0.0.1:8000 y que la variable VITE_API_BASE_URL esté bien configurada.
