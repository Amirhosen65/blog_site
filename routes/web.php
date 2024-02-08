<?php

use App\Http\Controllers\AboutController;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use App\Http\Controllers\AuthorController;
use App\Http\Controllers\AuthorRequestController;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\CategoryBlogController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\FrontendController;
use App\Http\Controllers\FrontTagController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SearchController;
use App\Http\Controllers\SiteIdentyController;
use App\Http\Controllers\SocialiteController;
use App\Http\Controllers\TagBlogController;
use App\Http\Controllers\TagController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/


Route::get('/', function () {
    return view('welcome');
});

// Frontend Controller
Route::get('/', [FrontendController::class, 'index'])->name('root');
Route::get('/blogs', [FrontendController::class, 'blogs'])->name('blogs');
Route::get('/contacts', [FrontendController::class, 'contacts'])->name('contacts');
Route::post('/contacts', [FrontendController::class, 'contacts_form'])->name('contacts.form');

Route::get('/category/blogs/{id}', [CategoryBlogController::class, 'index'])->name('category.blogs');
Route::get('/blogs/single/blog/{slug}', [CategoryBlogController::class, 'single_blog'])->name('single.blog');

Route::get('/tag/blogs/{id}', [FrontTagController::class, 'index'])->name('tag.blogs');

Route::get('/about', [AboutController::class, 'about'])->name('about');


// comment controller
Route::post('/single/blog/comment', [CommentController::class, 'index'])->name('blog.comment');


// Search Controller
Route::get('search/blogs', [SearchController::class, 'index'])->name('search.blogs');

// author controller
Route::get('user/register', [AuthorController::class, 'register_view'])->name('author.register.view');
Route::post('user/register', [AuthorController::class, 'register'])->name('author.register');
Route::get('user/login', [AuthorController::class, 'login_view'])->name('author.login.view');
Route::post('user/login', [AuthorController::class, 'login'])->name('author.login');
Route::get('author/requests', [AuthorController::class, 'authors'])->name('authors.requests');
Route::get('author/rejected/all', [AuthorController::class, 'authors_reject_all'])->name('authors.rejected.all');
Route::get('author/requests/{id}', [AuthorRequestController::class, 'authors_requests'])->name('authors.send.requests');

// author profile controller
Route::get('author/profile/{id}', [AuthorController::class, 'author_profile'])->name('authors.profile');
Route::get('authors/all', [AuthorController::class, 'authors_all'])->name('authors.all');


// Author request controller
Route::post('author/rejected/{id}', [AuthorRequestController::class, 'authors_rejected'])->name('authors.rejected');
Route::post('author/approved/{id}', [AuthorRequestController::class, 'authors_approved'])->name('authors.approved');
Route::post('author/block/{id}', [AuthorRequestController::class, 'authors_block'])->name('authors.block');
Route::get('author/approved/list', [AuthorRequestController::class, 'authors_list'])->name('authors.list');

// contact mailbox controller
Route::get('/contact/mailbox', [FrontendController::class, 'mailbox'])->name('contact.mailbox');
Route::get('/mail/delete/{id}', [FrontendController::class, 'mail_delete'])->name('mail.delete');


// Site identity
Route::get('/site/identity', [SiteIdentyController::class, 'site_identity'])->name('site.identity');
Route::post('/site/title/{id}', [SiteIdentyController::class, 'title_update'])->name('site.title.update');
Route::post('/site/favicon/{id}', [SiteIdentyController::class, 'favicon_update'])->name('favicon.update');
Route::post('/site/footer/{id}', [SiteIdentyController::class, 'footer_update'])->name('footer.update');
Route::post('/site/logo/{id}', [SiteIdentyController::class, 'logo_update'])->name('logo.update');
Route::post('/site/about/{id}', [SiteIdentyController::class, 'about_update'])->name('about.update');
Route::post('/site/contact/{id}', [SiteIdentyController::class, 'contact_update'])->name('contact.update');


Auth::routes(['register' => false]);

// Dashboard route

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->middleware(['auth', 'verified', 'approve_status'])->name('home');

//profile controler
Route::get('/profile', [ProfileController::class, 'index'])->name('profile.index');
Route::post('/profile/name/update/{id}', [ProfileController::class, 'name_update'])->name('profile.name.update');
Route::post('/profile/image/update/{id}', [ProfileController::class, 'image_update'])->name('profile.image.update');
Route::post('/profile/email/update/{id}', [ProfileController::class, 'email_update'])->name('profile.email.update');
Route::post('/profile/password/update/{id}', [ProfileController::class, 'password_update'])->name('profile.password.update');

// category controller
Route::get('/category', [CategoryController::class, 'index'])->name('category');
Route::post('/category/insert', [CategoryController::class, 'insert'])->name('category.insert');
Route::post('/category/delete/{id}', [CategoryController::class, 'delete'])->name('category.delete');
Route::get('/category/edit/{id}', [CategoryController::class, 'edit_index'])->name('category.edit.index');
Route::post('/category/edit/{id}', [CategoryController::class, 'edit'])->name('category.edit');
Route::post('/category/change/status/{id}', [CategoryController::class, 'status'])->name('category.status');

// tag controller

Route::get('/tag', [TagController::class, 'index'])->name('tag');
Route::post('/tag/insert', [TagController::class, 'insert'])->name('tag.insert');
Route::post('/tag/change/status/{id}', [TagController::class, 'status'])->name('tag.status');
Route::post('/tag/delete/{id}', [TagController::class, 'delete'])->name('tag.delete');

// blog post controller
Route::get('/blog/view', [BlogController::class, 'index'])->name('blog.index');
Route::get('/blog/insert/view', [BlogController::class, 'insert_view'])->name('blog.insert.view');
Route::post('/blog/insert', [BlogController::class, 'insert'])->name('blog.insert');
Route::post('/blog/change/status/{id}', [BlogController::class, 'status'])->name('blog.status');
Route::get('/blog/edit/{id}', [BlogController::class, 'blog_edit'])->name('blog.edit');
Route::post('/blog/edit/{id}', [BlogController::class, 'update'])->name('blog.edit.update');
Route::get('/blog/feature/{id}', [BlogController::class, 'feature'])->middleware('rolecheck')->name('blog.feature');

Route::post('/blog/delete/{id}', [BlogController::class, 'delete'])->name('blog.delete');
Route::get('/blog/trash', [BlogController::class, 'trash'])->name('blog.trash');
Route::post('/blog/restore/{id}', [BlogController::class, 'restore'])->name('blog.restore');
Route::post('/blog/forcedelete/{id}', [BlogController::class, 'forcedelete'])->name('blog.forcedelete');
Route::post('/blog/delete-all', [BlogController::class, 'delete_all'])->name('blog.delete.all');

// users controller

Route::get('/users', [UserController::class, 'index'])->name('users.index');
Route::get('/user/add', [UserController::class, 'add_view'])->middleware('rolecheck')->name('user.add.view');
Route::post('/user/add', [UserController::class, 'add'])->middleware('rolecheck')->name('user.add');
Route::post('/user/delete/{id}', [UserController::class, 'delete'])->middleware('rolecheck')->name('user.delete');
Route::get('/user/edit/{id}', [UserController::class, 'edit_view'])->middleware('rolecheck')->name('user.edit');
Route::post('/user/edit/{id}', [UserController::class, 'update'])->middleware('rolecheck')->name('user.update');
Route::get('/user/requests', [UserController::class, 'requests'])->middleware('rolecheck')->name('user.requests');
Route::post('/user/requests/approve/{id}', [UserController::class, 'request_approve'])->middleware('rolecheck')->name('user.requests.approve');


// Email verification
Route::get('/email/verify', function (Request $request) {
    $request->user()->sendEmailVerificationNotification();
    return view('auth.verify');
})->middleware('auth')->name('verification.notice');

Route::get('/email/verify/{id}/{hash}', function (EmailVerificationRequest $request) {
    $request->fulfill();

    return redirect('/author/login');
})->middleware(['auth', 'signed'])->name('verification.verify');

Route::post('/email/verification-notification', function (Request $request) {
    $request->user()->sendEmailVerificationNotification();

    return back()->with('message', 'Verification link sent!');
})->middleware(['auth', 'throttle:6,1'])->name('verification.send');

// socialite
Route::get('/auth/{provider}/redirect', [SocialiteController::class, 'redirect']);
Route::get('/auth/{provider}/callback', [SocialiteController::class, 'callback']);


