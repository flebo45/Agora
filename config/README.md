# DOCTRINE USAGE

# Table of Contents

1. [About](#about)
1. [Usage](#usage)

## About

This web application use the principles of the MVC design pattern. It have two main folders: `app` and `appORM`. These two are the main core of the application and are the same one, the difference is the implementation. In the `app` there is the project that implement the **foundation layer** using only **SQL**; in the `appORM` the layer is implemented using **DoctrineORM**.

The main difference is that with Doctrine we work nearly to the objects and put in the background the inetration with the database: we have more complex entities but a lighter foundation layer, more speed in taking data and so on.

## Usage

In this folder there is a file called `config.php`. In this file there are all the parameters to customize you **Agora** web app. There are also **database connection parameters**, that you have to configure according to you settings. And in the end there is a parameter called `USE_DOCTRINE`. If this parameter is **true** the application will use the `appORM` and so it will use Doctrine, if is **false** the application will use the `app` and so it will use base SQL
