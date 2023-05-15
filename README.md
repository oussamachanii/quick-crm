
# Quick CRM

## Description
This quick crm is a quick (As its title said) Crm application, that represent my learning path though the best laravel implementation and the more suitable coding struction.

## Used Tech Stack
- Php
- laravel
- Vite
- Tailwind

## Installing steps
### Using Docker
- If docker is installed in your machine or you want to feel project installing experience using it, [You can install it from here](https://docs.docker.com/desktop/install/mac-install/).

- [ ] Clone Code Using ssh
```
git clone git@github.com:oussamachanii/quick-crm.git
```

- [ ] Change directory to the cloned project

```
cd quick-crm/
```

- [ ] Run the build script
```
bash build.sh
```
  
  Which will 
  - Build the necessary containers
    - Php8.2 alpine [8000]
    - Mysql [3306]
    - MailHog [1025]
 -  Install and run composer
 -  Install node and npm for assets building
 -  Run migration and seed the migrated database

## Pages
### Admin space
Name                                  | Method | Path
--------------------------------------|--------|--------------------------------------------
Admin Dashboard                       | GET    | `/admin`
Show Create Admin Page                | GET    | `/admin/create`
Create Admin                          | POST   | `/admin/create`
List Companies                        | GET    | `/admin/company`
Show Create Company Page              | GET    | `/admin/company/create`
Store Company                         | POST   | `/admin/company`
Edit Company                          | GET    | `/admin/company/{id}`
Update Company                        | POST   | `/admin/company/{id}`
Delete Company                        | DELETE | `/admin/company/{id}`
List Invitations                      | GET    | `/admin/invitation`
Show Create Invitation Page           | GET    | `/admin/invitation/create`
Store Invitation                      | POST   | `/admin/invitation/create`
Delete Invitation                     | DELETE | `/admin/invitation/{id}`
Validate Invitation form employees    | POST   | `/admin/invitation/{id}/validate`
List Admins                           | GET    | `/admin/list`
Show Login Page                       | GET    | `/admin/login`
Authenticate Admin                    | POST   | `/admin/login`
Logout Admin                          | POST   | `/admin/logout`

### Employee space
Name                                  | Method | Path
--------------------------------------|--------|--------------------------------------------
Employee Dashboard                    | GET    | `/employee`
Edit Employee Profile                 | GET    | `/employee/edit`
Update Employee Profile               | POST   | `/employee/edit`
Show Employee Login Page              | GET    | `/employee/login`
Authenticate Employee                 | POST   | `/employee/login`
Logout Employee                       | POST   | `/employee/logout`
Submit Invitation                     | POST   | `/invitation/connect`
Connect Invitation                    | GET    | `/invitation/connect/{token}`
