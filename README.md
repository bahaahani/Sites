# Magento 2 Development Project - Bahaa Shamtoot

This is a Magento 2 development project implementing various features as part of a technical task.

## Features Implemented

### Custom Theme
- Created a child theme based on Luma theme
- Enhanced styling for product pages
- Custom CSS for various components

### Popup Module
- Added a dialog/popup to every page except category pages
- Configurable content and styling
- Shown only once per session using localStorage

### Related Products Tab
- Repositioned "Related Products" to appear inside a new tab
- Customized styling for the tab and related products

### Custom Module "Bahaa_Shamtoot"
- Added frontend route that forwards to a product page
- Clean architecture following Magento 2 standards

### Product Labels Module (Bonus Feature)
- Adds "Sale" and "New" labels to products
- Shows discount percentage on sale items
- Applies to both product listing and product view pages

## Installation

1. Clone this repository into your Magento 2 installation
2. Run the following commands:

```bash
bin/magento setup:upgrade
bin/magento setup:di:compile
bin/magento setup:static-content:deploy -f
bin/magento cache:clean
bin/magento cache:flush
```

3. Access the admin panel to configure the product labels through Stores > Configuration > Bahaa Extensions > Product Labels

## Development Notes

This project was built using:
- Magento 2 Community Edition
- Docker-based development environment
- Sample data for product catalog

## Author

Bahaa Shamtoot 