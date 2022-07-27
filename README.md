## Project Overview 🎉

It is the backend part of the "Base PC" application which is an online store.

The application is a project made for the purposes of the diploma thesis at The Witelon State University of Applied Sciences in Legnica

## Tech/framework used 🔧

|     Tech    |        Description        |
|:-----------:|:-------------------------:|
|   Laravel   |       PHP framework       |
|   MariaDB   |          Database         |
|    Docker   | Containerization platform |
| Meilisearch |       Search engine       |
|   Mailgun   |         Email API         |
|     OCI     |    Deployment platform    |
|    AWS S3   |       Object storage      |

## Installation 💾

1. ``docker-compose up -d``
2. ``mv .env.example .env``
3. ``docker exec --it <container_id> composer install``
4. ``docker exec --it <container_id> migrate fresh``
5. visit http://localhost:8081

## Features

1. JWT Auth

2. Google Auth

3. Password reset

4. Search engine

5. CRUD for products and categories

6. Images upload

7. Adding product reviews and rating them

8. Shopping cart

## Live 📍

https://icnav.online
