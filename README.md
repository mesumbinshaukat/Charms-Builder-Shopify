# Charm Builder Shopify App

## Setup Instructions

1. **Install XAMPP** and start Apache.
2. **Clone this repo** into `htdocs`.
3. **Install Composer dependencies:**
   ```
   composer install
   ```
4. **Copy `.env.example` to `.env`** and fill in:
   - `SHOPIFY_API_KEY`, `SHOPIFY_API_SECRET` (provided above)
   - `NGROK_URL` (after running ngrok)
5. **Start ngrok:**
   ```
   ngrok http 80
   ```
   - Copy the HTTPS URL to `.env` as `NGROK_URL`.
6. **Whitelist ngrok URL** in Shopify Partners app settings (App setup > App URL, Redirect URL).
7. **Install app in your Shopify store:**
   - Visit: `http://localhost/Charms-Builder-Shopify/public/install.php?shop=YOUR_SHOP.myshopify.com`
   - Complete OAuth.
8. **Access Admin Dashboard:**  
   `http://localhost/Charms-Builder-Shopify/public/admin.php`
9. **Integrate Builder in Theme:**
   - Upload `vue.min.js`, `app.js`, `style.css` to theme assets.
   - Add `page.charm-builder.liquid` to theme.
   - Create a new page using this template.

---

## Project Structure

- `public/` – PHP entry points and builder assets
- `src/` – PHP classes (Shopify API, order logic)
- `theme/` – Liquid template and theme assets

---

## Your Action Checklist

1. Copy Client ID/Secret into `.env`.
2. Start XAMPP (Apache).
3. Run `composer install` in project root.
4. Start ngrok and copy HTTPS URL to `.env` and Shopify app settings.
5. Whitelist ngrok URL in Shopify Partners.
6. Install app via `/install.php?shop=YOUR_SHOP.myshopify.com`.
7. Upload builder assets to Shopify theme.
8. Create new page using the "charm-builder" template.
9. Test builder and admin dashboard. 