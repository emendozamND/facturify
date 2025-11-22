Facturify --- Orders Processing System (Laravel 11 + React + MySQL)

Este proyecto implementa un sistema para procesar órdenes,
calcular totales, aplicar descuentos y almacenar la información en una
base de datos MySQL.\
El frontend en React consume la API desarrollada en Laravel 11.
Base de datos MySQL en Docker
Esto permite:

Aislar el ambiente

Evitar conflictos con otras versiones de MySQL instaladas

Portabilidad del proyecto

Cálculo en un “Service” separado
Mejora mantenibilidad, testability y claridad de la lógica.

Uso de factories y seeders avanzados
Para generar datos coherentes que representen casos reales.

Frontend separado (React + TS)
Para simular una arquitectura real de microservicios/API + cliente

---

## Estructura del Proyecto

    facturify/
      backend/     API REST en Laravel 11
      frontend/    Cliente web en React + TypeScript

---

## 1. Cómo correr el proyecto

## Backend (Laravel 11)

### Instalación:

```bash
cd facturify/backend
cp .env.example .env
composer install
php artisan key:generate
```

### Ejecutar migraciones y seeders:

```bash
php artisan migrate --seed
```

### Levantar servidor:

```bash
php artisan serve
```

---

## Frontend (React + TypeScript)

```bash
cd facturify/frontend
npm install
npm run dev
```

---




