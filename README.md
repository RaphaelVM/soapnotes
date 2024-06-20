# SoapNotes

SoapNotes is a notes application that allows you to add notes and categories and attach categories to notes.

## Getting Started

Follow these instructions to set up and run SoapNotes on your local machine.

### Running the Application

To run the application locally on MacOS, you can use the custom `runlocal.sh` script. Execute the script with the following command:

```bash
sh runlocal.sh
```

### Database Migration and Seeding

Run the following command to migrate the database and seed it with initial data:

   ```bash
   php artisan migrate --seed
   ```

### Image Previews in RichEditor

If image previews are not working in the RichEditor, it might be due to the missing storage link. You can create the necessary storage link by running the following command:

```bash
php artisan storage:link
```

This will link the storage directory to the public directory, allowing images to be accessible.

---

Enjoy using SoapNotes! If you have any questions or need further assistance, please don't hesitate to reach out.
