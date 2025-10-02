**CUENTAD3** 

CUENTAD3 es una plataforma web desarrollada en **Laravel** como proyecto de tesis.
Ofrece una experiencia completa que combina noticias, tienda online, gestión de eventos con entradas y funcionalidades de comunidad relacionadas con la lucha libre independiente.

---

**Tecnologías utilizadas**

Laravel 12.x
 (Backend)

PHP 8.3

MySQL
 (Base de datos)

Bootstrap 5
 (Frontend)

Laravel Breeze
 (Autenticación)

MercadoPago SDK
 (Pagos)

Hosting en Hostinger

---

**Requisitos previos**

Antes de instalar el proyecto, asegurate de tener instalado:

**PHP >= 8.1**

**Composer 2**

**MySQL**

**Node.js + NPM (opcional, si querés compilar assets)**

**Git**

---

**Instalación y ejecución**

1. **Clonar el repositorio**

git clone https://github.com/FranciscoVola/cuentad3.git

cd cuentad3

2. **Instalar dependencias de PHP**

composer install

3. **Copiar el archivo de entorno y configurar las variables**

cp .env.example .env

**Configura en .env:**

DB_DATABASE, DB_USERNAME, DB_PASSWORD

APP_URL (por ejemplo: http://localhost:8000)

MERCADOPAGO_ACCESS_TOKEN (para pagos)

4. **Generar la key de la aplicación**

php artisan key:generate


5. **Ejecutar migraciones (y seeders si están configurados)**

php artisan migrate --seed


6. **Crear el enlace simbólico para las imágenes**

php artisan storage:link


7. **Levantar el servidor**

php artisan serve

El sitio estará disponible en: http://localhost:8000

Funcionalidades principales

Registro e inicio de sesión con roles (usuario/admin).

Gestión de productos (tienda online).

Sistema de carrito de compras.

Integración con MercadoPago para pagos.

Gestión de entradas a eventos (con confirmación por mail y QR).

Sección de noticias.

Módulo de luchadores con ranking y simulador.

Panel de administración completo.

**Autor**

Desarrollado por Francisco Vola

Proyecto presentado como tesis final de la carrera de Programación Web.