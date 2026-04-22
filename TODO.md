# Profile Image Upload Feature - TODO

## Steps to Complete:

- [x] Step 1: Create migration \`php artisan make:migration add_avatar_to_users_table --table=users\`
- [x] Step 2: Edit migration to add avatar column and run \`php artisan migrate\`
- [x] Step 3: Run \`php artisan storage:link\` (if needed)
- [x] Step 4: Update app/Models/User.php - add 'avatar' to \$fillable
- [x] Step 5: Update app/Http/Controllers/ProfileController.php - add avatar validation and upload logic
- [x] Step 6: Update resources/views/profile.blade.php - conditional avatar display
- [x] Step 7: Update resources/views/profile/edit.blade.php - add image upload field + preview
- [ ] Step 8: Create public/images/default-avatar.png
- [ ] Step 9: Test feature (upload, display, edit)
- [ ] Step 10: Update TODO.md with completion status

Current progress: Step 4 - Model updated, moving to controller
