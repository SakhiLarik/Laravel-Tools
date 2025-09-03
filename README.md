# My Tools Page

This website is a collection of powerful, user-friendly tools built using Laravel and enhanced with modern JavaScript and Tailwind CSS. The primary purpose of this website is to provide practical utilities for everyday tasks, including text analysis, unit conversion, currency conversion, expense management, and QR code generation. Each tool is designed to be responsive, intuitive, and accessible, catering to a wide range of users from individuals to professionals.

## Tools
- Scientific Calculator _(Done)_
- Expense Calculator _(Done)_
- Text Analyzer _(Done)_
- Advanced Unit Convertor _(Done)_
- Currency Convertor _(Done)_
- QR Code Generator _(Done)_
- Age Calculator _(DONE)_
- Website Speed Checker
- IP Address Finder
- Backlinks Checker
- Image to PDF
- Word to PDF
- PDF to Word
- Time zone Convertor
- Image to Text
- BMI Calculator
- Adsense Earning Calculator
- Image Donwloader
- Video Downloader
- Image Size Compressor
- Domain Age Checker


## Features

### Scientific Calculator
- **Purpose**: Perform advanced mathematical and scientific calculations to assist with complex computations.
- **Features**:
  - Supports a wide range of operations including basic arithmetic (addition, subtraction, multiplication, division), trigonometric functions (sin, cos, tan), logarithms, exponents, and square roots.
  - Interactive interface with real-time result updates as inputs are entered.
  - Mobile-responsive design using Tailwind CSS, ensuring usability on various devices.
  - Ideal for students, engineers, and professionals needing quick scientific computations.

### Expense Calculator
- **Purpose**: Calculate and manage expenses and income effectively to track financial health.
- **Features**:
  - Add, view, and delete transactions (income or expenses) with descriptions and amounts.
  - Displays total income, total expenses, and balance with color-coded indicators (green for positive, red for negative).
  - Persistent transaction history using localStorage, with a responsive table layout.


### Text Analyzer
- **Purpose**: Analyze text input to provide insights such as character count, word count, sentence count, and average word length.
- **Features**:
  - Real-time analysis as text is typed.
  - Responsive design with a clean interface using Tailwind CSS.
  - Ideal for writers, editors, and students to evaluate text content.

### Advanced Unit Converter
- **Purpose**: Convert between various units across categories like length, mass, temperature, area, volume, speed, time, pressure, and energy.
- **Features**:
  - Supports a wide range of units for each category (e.g., meters to miles, Celsius to Fahrenheit).
  - Dynamic unit selection based on the chosen category.
  - Mobile-responsive layout with real-time conversion results.

### Currency Converter
- **Purpose**: Convert amounts between all recognized non-digital currencies worldwide using approximate exchange rates.
- **Features**:
  - Includes official currencies (e.g., USD, EUR, JPY) with their ISO codes.
  - Real-time conversion with a dropdown for selecting from and to currencies.
  - Responsive design optimized for both desktop and mobile users.

### QR Code Generator
- **Purpose**: Generate QR codes from user inputs, including text, URLs, and uploaded files.
- **Features**:
  - Supports three input types: text, URL/link, and file upload.
  - File upload feature stores files on the server and generates a QR code for the download URL (up to MB limit).
  - Includes a download option for the generated QR code and error handling for large or invalid inputs.
  - Responsive design with a dynamic input interface.

## Installation and Setup
**Clone the Repository**:
   ```bash
   git clone <repository-url>
   cd <project-directory>
   ```
**Install Dependencies**:
- Ensure PHP, Composer, and Node.js are installed.
- Run:
```bash
composer install
npm install
```

Configure Environment:
- Copy `.env.example` to `bash.env` and update the database and application settings. 
- Generate an application key:
```bash
php artisan key:generate
```
**Setup Storage**:

- Link the storage directory for file uploads:
```bash
php artisan storage:link
```
- Ensure `storage` and `public/uploads` (if used) have proper permissions:
```bash
chmod -R storage
chown -R $USER:www-data storage
mkdir -p public/uploads
chmod -R public/uploads
chown -R $USER:www-data public/uploads
```
Run the Application:

- Start the Laravel development server:
```bash
php artisan serve
```
Access the site at `http://localhost:`.

## Usage

- Navigate to the respective tool page from the website's main interface.
- Input the required data (e.g., text, units, currency amounts, transactions, or files).
- Use the generated results or download options as needed.
- For file uploads in the QR Code Generator, ensure files are under MB for successful processing.

## Contributing
Contributions are welcome! Please fork the repository, create a feature branch, and submit a pull request with your changes. Ensure to follow the existing code style and include tests where applicable.

## License
This project is licensed under the MIT License.
## Contact

For questions or support, please open an issue on the repository or contact the maintainers.

`Last Updated: :PM PKT, Tuesday, August `