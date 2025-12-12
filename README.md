#  Bodega API - Proyecto Final DevOps

![Build Status](https://img.shields.io/badge/build-passing-brightgreen) ![PHP](https://img.shields.io/badge/PHP-8.4-777BB4) ![Laravel](https://img.shields.io/badge/Laravel-11-FF2D20) ![Docker](https://img.shields.io/badge/Docker-Enabled-2496ED)

##  Descripción
Este proyecto consiste en una **API RESTful** para la gestión de inventario, desarrollada con una arquitectura de microservicios y un flujo de trabajo **DevOps completo**.

El objetivo principal no es solo la gestión de productos, sino la implementación de un pipeline de **Integración y Despliegue Continuo (CI/CD)** que garantiza calidad, seguridad y automatización desde el código hasta la producción.

---

##  Stack Tecnológico

* **Backend:** Laravel 11 (PHP 8.4)
* **Base de Datos:** MySQL 8.0 (Contenerizada)
* **Infraestructura:** Servidor Ubuntu Server 24.04 LTS (On-Premise / VirtualBox)
* **Contenerización:** Docker & Docker Compose
* **Orquestación:** GitHub Actions (Self-Hosted Runner)
* **IaC (Infraestructura como Código):** Ansible
* **Calidad & Seguridad:** PHPUnit, Larastan, Trivy Security Scanner

---

##  Arquitectura del Pipeline (CI/CD)

Cada vez que se realiza un `git push` a la rama `main`, se dispara un flujo automatizado en GitHub Actions:

1.  **  Fase de Test:**
    * Instalación de dependencias.
    * Análisis estático de código con **Larastan**.
    * Ejecución de pruebas unitarias con **PHPUnit**.
2.  ** Fase de Build & Security:**
    * Construcción de la imagen Docker optimizada.
    * Escaneo de vulnerabilidades críticas (CVEs) con **Trivy**.
    * Subida de la imagen a **Docker Hub** (`aarondevops/bodega-api`).
3.  ** Fase de Deploy:**
    * Activación del **Self-Hosted Runner** en el servidor local.
    * Ejecución de Playbook de **Ansible**.
    * Descarga de la nueva imagen y reinicio de contenedores sin tiempo de inactividad (Zero Downtime deployment).

---

## 🔌 Endpoints Principales

La API expone los siguientes recursos:

| Método | Endpoint | Descripción |
| :--- | :--- | :--- |
| `GET` | `/api/products` | Lista todos los productos (Ordenados por novedad). |
| `POST` | `/api/products` | Crea un nuevo producto (Valida SKU único). |
| `GET` | `/api/products/{id}` | Obtiene el detalle de un producto. |

---

##  Autor
**Aaron Segura**
*Proyecto Transformación Digital  / Evaluación Final - 2025*