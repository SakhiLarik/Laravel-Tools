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
- Website Speed Checker _(DONE)_
- IP Address Finder _(DONE)_
- Backlinks Checker
- Image to PDF
- Word to PDF
- PDF to Word
- Time zone Convertor _(Done)_
- Image to Text
- BMI Calculator _(DONE)_
- Adsense Earning Calculator _(DONE)_
- Image Donwloader
- Video Downloader
- Image Size Compressor
- Domain Age Checker

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