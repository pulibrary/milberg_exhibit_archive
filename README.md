# pcdm.org

This is a static site of what was a Wordpress website of the milberg exhibit


# Nginx Docker Container for Serving XML Files

This project provides a Dockerized Nginx server configured to serve the milberg exhibit. It was formerly a wordpress site.


## Table of Contents

- [Introduction](#introduction)
- [Prerequisites](#prerequisites)
- [Installation](#installation)
- [Usage](#usage)
- [Configuration](#configuration)
- [Docker Compose](#docker-compose)
- [File Structure](#file-structure)
- [Troubleshooting](#troubleshooting)
- [Contributing](#contributing)
- [License](#license)

## Introduction

This repository contains the necessary files to build and run a Docker container with Nginx serving the wordpress converted static site files. The project is designed to be flexible and easy to use, with a configurable server name and a custom Nginx configuration optimized for serving static content.

## Prerequisites

- Docker Engine and Docker Compose installed.  See the official Docker documentation for installation instructions: [https://docs.docker.com/](https://docs.docker.com/)
- A directory containing your static files.
- A custom Nginx configuration file (e.g., `default.conf`).

## Installation

1. Clone this repository (or copy the necessary files) to your local machine.
2. Place your static files in the same directory as the `Dockerfile`.
3. Ensure you have a `default.conf` file with your Nginx configuration in the same directory.  A sample configuration is provided below.

## Usage

1. **Build the Docker image:**

   ```bash
   docker build -t milberg .
