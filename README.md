# COMP2140-138-Laundry-Software

## What is 138 Laundry Software?

The 138 Student Living Dorms represent the latest student housing options on the UWI Mona Campus. Their accommodations have been praised as the best across the campus for their modern approach compared to other dorms, however, one key aspect that is constantly a complaint across the dorms is the laundry accommodations that have constantly long physical lines for the residents. The 138 Dormitory Laundry system is a self-contained product aimed at enhancing the laundry amenities provided by the 138 Student Living Dormitory for residents. It is not intended to replace an existing system but rather introduce a new, efficient method of managing laundry services within the Dormitory. The software operates as a component of the larger 138 Student Living laundry accommodations system where residents utilize this software for reserving machines instead of waiting physically. The residents then utilize the laundry machines at scheduled times using the 138 Student Living laundry system’s ticketing system for authenticating their time and machine use.

## How to Use

### Prerequisites
- Ensure you have PHP installed on your local machine. You can download it [here](https://www.php.net/downloads.php), or use a software stack such as [WAMP](https://www.wampserver.com/en) or [XAMPP](https://www.apachefriends.org) for ease of installation instead.

### Installation
1. Clone the laundry software repository to your local machine:

    ```bash
    git clone https://github.com/dameliac/COMP2140-138-Laundry-Software.git
    ```

2. Navigate to the project directory:

    ```bash
    cd COMP2140-138-Laundry-Software
    ```

3. Start a local PHP server:

    ```bash
    php -S localhost:8000
    ```

#### Using MySQL Client (e.g. phpMyAdmin)
1. Open your phpMyAdmin client.
2. Navigate to the import tab at the top of the GUI.
3. Import the SQL database file [storage/138users.sql](storage/138users.sql).
4. For demo purposes all usernames are the same as passwords for every user included in the sql file.

### Running the Application
1. Open your web browser and go to [http://localhost:8000](http://localhost:8000).
2. Explore the different pages and functionalities provided by the dynamic website.