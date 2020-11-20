sudo chown -R $USER:www-data storage
sudo chown -R $USER:www-data bootstrap/cache
sudo chown -R $USER:www-data public/invoice/
chmod -R 775 storage
chmod -R 775 bootstrap/cache
chmod -R 775 public/invoice/
