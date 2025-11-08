# Gulu University Teaching Hospital — Website

Overview
- Static, responsive website for Gulu University Teaching Hospital: Home, About, Departments, Appointment form, News.
- Built with semantic HTML and a shared stylesheet (style.css). Minimal JavaScript is used only for progressive enhancements.

Project structure
- index.html — Home page
- about.html — History, Mission, Vision (Gulu University Teaching Hospital)
- departments.html — Department summaries and services
- appointment.html — Booking form (server-side handler: process.php)
- news.html — Announcements
- style.css — Shared styles
- /assets/
  - images/ — logos, hero and service images (replace placeholders)
  - icons/ — optional svg/png icons
- process.php — server-side form handler (if using PHP)
- README.md — this file

Local setup (XAMPP on Windows)
1. Install XAMPP and start Apache (and MySQL if needed).
2. Place the project folder in XAMPP's htdocs:
   - C:\xampp\htdocs\Hospital_Website_Project
3. Open in browser:
   - http://localhost/Hospital_Website_Project/index.html
4. If using forms that post to process.php, ensure PHP is enabled in XAMPP and test via the above URL.

Contacts
- Main reception: +256 39 1234567
- Location: Gulu, Northern Region, Uganda

Notes
- Replace placeholder images in assets/images (logo.png, hero.jpg, service images).
- Adjust any phone/address placeholders to match your real contact details.
- To keep content consistent, the site uses "Gulu University Teaching Hospital" across pages.

Git & branches (local workflow)
- Initialize a Git repo (if not already): git init
- Common commands:
  - git status
  - git branch
  - git checkout -b feature/name
  - git add . && git commit -m "message"

Accessibility & testing
- Test keyboard navigation and focus states.
- Verify color contrast for text and CTAs with a contrast checker.
- Test on multiple widths (mobile, tablet, desktop) via browser devtools.