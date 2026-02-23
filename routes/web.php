<?php

use App\Http\Controllers\Admin\MemberController;
use App\Http\Controllers\Admin\News\CategoryController as AdminCategoryController;
use App\Http\Controllers\Admin\News\NewsController as AdminPostController;
use App\Http\Controllers\Admin\News\TagController as AdminTagController;
use App\Http\Controllers\AdministratorController;
use App\Http\Controllers\AgendaController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\ForgetPasswordControler;
use App\Http\Controllers\HBNController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LaravoltController;
use App\Http\Controllers\LibraryController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\News\CategoryController;
use App\Http\Controllers\News\NewsController;
use App\Http\Controllers\News\TagController;
use App\Http\Controllers\PACController;
use App\Http\Controllers\PDFController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\QrCodeController;
use App\Http\Controllers\QuoteController;
use App\Http\Controllers\Admin\Letter\IncomingLetterController;
use App\Http\Controllers\Admin\Letter\OutgoingLetterController;
use App\Http\Controllers\Admin\Letter\SPController;
use App\Http\Controllers\StatisticController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/emails', function () {
    return view('mails.reset');
});

Route::get('/download/sp/{pac}/{id}/{filename}', [
    \App\Http\Controllers\Admin\Letter\SPController::class,
    'downloadStructureFile',
])->name('download.structure');

Route::get('/', [HomeController::class, 'index'])->name('index');
Route::get('/news', [NewsController::class, 'index'])->name('news');
Route::get('/administrators', [AdministratorController::class, 'show'])->name('administrators');
Route::get('/contact', [ContactController::class, 'create'])->name('contact.create');
Route::post('/contact/store', [ContactController::class, 'store'])->name('contact.store');
Route::get('/news/{slug}', [NewsController::class, 'show'])->name('news.show');
Route::get('/news/nu/{slug}', [NewsController::class, 'nuNews'])->name('news.nu');
Route::get('/categories/{slug}', [CategoryController::class, 'show'])->name('categories');
Route::get('/tags/{slug}', [TagController::class, 'show'])->name('tags');
Route::get('/calendar', [AgendaController::class, 'index'])->name('calendar.index');
Route::get('/calendar/full', [AgendaController::class, 'getFull'])->name('calendar.full');
Route::get('/agenda/events', [AgendaController::class, 'getEvents']);
Route::get('/hbn/events', [HBNController::class, 'getHbnEvents']);
Route::get('/profiles/{slug}', [ProfileController::class, 'show'])->name('profile.user');
Route::get('/qrcode/varifikasi/kta/{id}/anjay/mabar/ckuahsksdfsihew/S3NAT-4NJ1NG-63lut-73ng/51-3nd1', [
    QrCodeController::class,
    'index',
]);
Route::get('/libraries', [LibraryController::class, 'index'])->name('libraries.index');
Route::get('/libraries/details/{id}', [LibraryController::class, 'show'])->name('libraries.details');
Route::get('/kta/users/download/pdf/{id}/my-kta/', [PDFController::class, 'cadrePDF'])->name('download.kta');

// Route Auth
Route::get('/login', [LoginController::class, 'login'])->name('login');
Route::get('/validation', [LoginController::class, 'showValidation'])->name('validation.index');
Route::post('/validation', [LoginController::class, 'validateUser'])->name('validation');
Route::get('/register/{users}', [LoginController::class, 'register'])->name('index.register');
Route::put('/register/{id}', [LoginController::class, 'store'])->name('register');
Route::post('/authenticate', [LoginController::class, 'authenticate'])->name('authenticate');
Route::get('/logout', [LoginController::class, 'logout'])->name('logout');

// Route Auth Pengunjung Kader Admin, Superadmin
Route::middleware(['auth', 'role:1,2,3,4'])->group(function () {
    Route::post('/comments', [CommentController::class, 'store'])
        ->name('comments.store')
        ->middleware('auth');
    Route::get('/profile', [ProfileController::class, 'index'])
        ->name('profile')
        ->middleware(['auth']);
    Route::get('/account', [ProfileController::class, 'showAccount'])
        ->name('account')
        ->middleware(['auth']);
    Route::put('/profile/update', [ProfileController::class, 'update'])
        ->name('profile.update')
        ->middleware(['auth']);
    Route::get('/account/new-password', function () {
        return redirect()->route('account');
    });
    Route::post('/account/new-password', [ProfileController::class, 'changePassword'])
        ->name('change-password')
        ->middleware(['auth']);
});

// Route Kader, Admin, Superadmin
Route::middleware(['auth', 'role:1, 2, 3'])->group(function () {
    Route::get('/uploads', [ProfileController::class, 'showUploads'])
        ->name('uploads')
        ->middleware(['auth']);
    Route::post('/profile/post/store', [ProfileController::class, 'storePost'])->name('profile.post.store');
    Route::post('/profile/libraries/store', [ProfileController::class, 'storeLibrary'])->name(
        'profile.libraries.store',
    );
});

require __DIR__ . '/auth.php';

// Route for Address Package
//Route::get('contoh-laravolt', [LaravoltController::class, 'index'])->name('laravolt.index');
Route::get('city', [LaravoltController::class, 'showCity'])->name('city');
Route::get('district', [LaravoltController::class, 'showDistrict'])->name('district');
Route::get('village', [LaravoltController::class, 'showVillage'])->name('village');

// Route Admin & Superadmin
Route::middleware(['auth', 'role:1,2,3'])->group(function () {
    Route::prefix('dashboard')
        ->as('dashboard.')
        ->group(function () {
            Route::resource('members', MemberController::class);
            Route::get('makesta', [MemberController::class, 'showMakestaCadres'])->name('makesta');
            Route::get('lakmud', [MemberController::class, 'showLakmudCadres'])->name('lakmud');
            Route::get('lakut', [MemberController::class, 'showLakutCadres'])->name('lakut');
            Route::get('latinpel', [MemberController::class, 'showLatinpelCadres'])->name('latinpel');
            Route::get('members/ipnu', [MemberController::class, 'filterIPNU'])->name('members.ipnu');
            Route::get('members/ippnu', [MemberController::class, 'filterIPPNU'])->name('members.ippnu');
        });
    Route::get('/dashboard', [StatisticController::class, 'index'])->name('dashboard');
    Route::get('/dashboard/libraries', [LibraryController::class, 'adminIndex'])->name('admin.libraries.index');
    Route::get('/dashboard/libraries/create', [LibraryController::class, 'create'])->name('admin.libraries.create');
    Route::post('/dashboard/libraries/store', [LibraryController::class, 'store'])->name('admin.libraries.store');
    Route::get('/dashboard/libraries/{id}/edit', [LibraryController::class, 'edit'])->name('admin.libraries.edit');
    Route::put('/dashboard/libraries/{id}', [LibraryController::class, 'update'])->name('admin.libraries.update');
    Route::delete('/dashboard/libraries/{id}', [LibraryController::class, 'destroy'])->name('admin.libraries.destroy');

    Route::get('/dashboard/news/categories', [AdminCategoryController::class, 'index'])->name('categories.index');
    Route::get('/dashboard/news/categories/create', [AdminCategoryController::class, 'create'])->name(
        'categories.create',
    );
    Route::post('/dashboard/news/categories/store', [AdminCategoryController::class, 'store'])->name(
        'categories.store',
    );
    Route::get('/dashboard/news/categories/{id}/edit', [AdminCategoryController::class, 'edit'])->name(
        'categories.edit',
    );
    Route::put('/dashboard/news/categories/{id}', [AdminCategoryController::class, 'update'])->name(
        'categories.update',
    );
    Route::delete('/dashboard/news/categories/{id}', [AdminCategoryController::class, 'destroy'])->name(
        'categories.destroy',
    );

    Route::get('/dashboard/news/tags', [AdminTagController::class, 'index'])->name('tags.index');
    Route::get('/dashboard/news/tags/create', [AdminTagController::class, 'create'])->name('tags.create');
    Route::post('/dashboard/news/tags/store', [AdminTagController::class, 'store'])->name('tags.store');
    Route::get('/dashboard/news/tags/{id}/edit', [AdminTagController::class, 'edit'])->name('tags.edit');
    Route::put('/dashboard/news/tags/{id}', [AdminTagController::class, 'update'])->name('tags.update');
    Route::delete('/dashboard/news/tags/{id}', [AdminTagController::class, 'destroy'])->name('tags.destroy');

    Route::get('/dashboard/news', [AdminPostController::class, 'index'])->name('news.index');
    Route::get('/dashboard/news/create', [AdminPostController::class, 'create'])->name('news.create');
    Route::post('/dashboard/news/store', [AdminPostController::class, 'store'])->name('news.store');
    Route::get('/dashboard/news/{id}/edit', [AdminPostController::class, 'edit'])->name('news.edit');
    Route::put('/dashboard/news/{id}', [AdminPostController::class, 'update'])->name('news.update');
    Route::delete('/dashboard/news/{id}', [AdminPostController::class, 'destroy'])->name('news.destroy');

    Route::get('/dashboard/calendar', [AgendaController::class, 'adminIndex'])->name('admin.calendar.index');
    Route::get('/dashboard/calendar/create', [AgendaController::class, 'create'])->name('admin.calendar.create');
    Route::post('/dashboard/calendar/store', [AgendaController::class, 'store'])->name('admin.calendar.store');
    Route::get('/dashboard/calendar/{id}/edit', [AgendaController::class, 'edit'])->name('admin.calendar.edit');
    Route::put('/dashboard/calendar/{id}', [AgendaController::class, 'update'])->name('admin.calendar.update');
    Route::delete('/dashboard/calendar/destroy/{id}', [AgendaController::class, 'destroy'])->name(
        'admin.calendar.destroy',
    );

    Route::get('/dashboard/users/download-pdf/{id}', [PDFController::class, 'cadrePDF'])->name('users.cadre-pdf');
    Route::get('/dashboard/users/pac/pdf/{slug}', [PDFController::class, 'pacPDF'])->name('users.pac-pdf');

    Route::get('/dashboard/members/pac/{slug}', [MemberController::class, 'showByPAC'])->name('members.pac.list');
    Route::get('/dashboard/members/pac/{slug}/search', [MemberController::class, 'search'])->name(
        'dashboard.members.pac.search',
    );

    Route::get('/dashboard/pac', [PACController::class, 'index'])->name('pac.index');
    Route::get('/dashboard/pac/{slug}', [PACController::class, 'show'])->name('pac.show');

    Route::get('/dashboard/unverification/', [UserController::class, 'showUnverification'])->name('unverification');
    Route::get('/dashboard/noncadres/', [UserController::class, 'showNoncadres'])->name('noncadre');
    Route::get('/dashboard/national-days/', [HBNController::class, 'index'])->name('hbn.index');
    Route::get('/dashboard/national-days/create', [HBNController::class, 'create'])->name('hbn.create');
    Route::post('/dashboard/national-days/store', [HBNController::class, 'store'])->name('hbn.store');
    Route::get('/dashboard/national-days/{id}/edit', [HBNController::class, 'edit'])->name('hbn.edit');
    Route::put('/dashboard/national-days/{id}', [HBNController::class, 'update'])->name('hbn.update');
    Route::delete('/dashboard/national-days/{id}', [HBNController::class, 'destroy'])->name('hbn.destroy');
});

// Route Superadmin only
Route::middleware(['auth', 'role: 1'])->group(function () {
    Route::prefix('dashboard')
        ->as('dashboard.')
        ->group(function () {
            Route::resource('admins', UserController::class);
        });
    Route::get('/dashboard/cadres', [MemberController::class, 'index'])->name('cadres.index');
    Route::get('/dashboard/cadres/create', [MemberController::class, 'create'])->name('cadres.create');
    Route::post('/dashboard/cadres/store', [MemberController::class, 'store'])->name('cadres.store');
    Route::get('/dashboard/cadres/{id}/edit', [MemberController::class, 'edit'])->name('cadres.edit');
    Route::put('/dashboard/cadres/{id}', [MemberController::class, 'update'])->name('cadres.update');
    Route::delete('/dashboard/cadres/{id}', [MemberController::class, 'destroy'])->name('cadres.destroy');
    Route::get('/dashboard/cadres/{id}/view', [MemberController::class, 'view'])->name('cadres.view');

    Route::get('/dashboard/pages', [HomeController::class, 'adminIndex'])->name('pages.index');
    Route::get('/dashboard/pages/{id}/edit', [HomeController::class, 'edit'])->name('pages.edit');
    Route::put('/dashboard/pages/{id}', [HomeController::class, 'update'])->name('pages.update');

    Route::get('/dashboard/pac/create/new', [PACController::class, 'create'])->name('pac.create');
    Route::post('/dashboard/pac/store', [PACController::class, 'store'])->name('pac.store');
    Route::get('/dashboard/pac/{id}/edit', [PACController::class, 'edit'])->name('pac.edit');
    Route::put('/dashboard/pac/{id}', [PACController::class, 'update'])->name('pac.update');
    Route::delete('/dashboard/pac/{id}', [PACController::class, 'destroy'])->name('pac.destroy');

    Route::get('/dashboard/quotes/', [QuoteController::class, 'index'])->name('quotes.index');
    Route::get('/dashboard/quotes/create', [QuoteController::class, 'createQuote'])->name('quotes.create');
    Route::post('/dashboard/quotes/store', [QuoteController::class, 'storeQuote'])->name('quotes.store');
    Route::get('/dashboard/quotes/{id}/edit', [QuoteController::class, 'editQuote'])->name('quotes.edit');
    Route::put('/dashboard/quotes/{id}', [QuoteController::class, 'updateQuote'])->name('quotes.update');
    Route::delete('/dashboard/quotes/{id}', [QuoteController::class, 'destroyQuote'])->name('quotes.destroy');

    Route::get('/dashboard/administrators/', [AdministratorController::class, 'index'])->name('administrators.index');
    Route::get('/dashboard/administrators/create', [AdministratorController::class, 'create'])->name(
        'administrators.create',
    );
    Route::post('/dashboard/administrators/store', [AdministratorController::class, 'store'])->name(
        'administrators.store',
    );
    Route::get('/dashboard/administrators/{id}/edit', [AdministratorController::class, 'edit'])->name(
        'administrators.edit',
    );
    Route::put('/dashboard/administrators/{id}', [AdministratorController::class, 'update'])->name(
        'administrators.update',
    );
    Route::delete('/dashboard/administrators/{id}', [AdministratorController::class, 'destroy'])->name(
        'administrators.destroy',
    );
});

//admin PC role & SuperAdmin
Route::middleware(['auth', 'role:1,2'])->group(function () {
    Route::get('/dashboard/administrators/', [AdministratorController::class, 'index'])->name('administrators.index');
    Route::get('/dashboard/administrators/create', [AdministratorController::class, 'create'])->name(
        'administrators.create',
    );
    Route::post('/dashboard/administrators/store', [AdministratorController::class, 'store'])->name(
        'administrators.store',
    );
    Route::get('/dashboard/administrators/{id}/edit', [AdministratorController::class, 'edit'])->name(
        'administrators.edit',
    );
    Route::put('/dashboard/administrators/{id}', [AdministratorController::class, 'update'])->name(
        'administrators.update',
    );
    Route::delete('/dashboard/administrators/{id}', [AdministratorController::class, 'destroy'])->name(
        'administrators.destroy',
    );
});

Route::middleware(['auth', 'role:2,3'])->group(function () {
    Route::prefix('dashboard')
        ->as('dashboard.')
        ->group(function () {
            Route::prefix('letters')
                ->as('letters.')
                ->group(function () {
                    // Incoming
                    Route::get('incoming/print', [IncomingLetterController::class, 'print'])->name('incoming.print');
                    Route::delete('incoming/attachments/{attachment}', [
                        IncomingLetterController::class,
                        'destroyAttachment',
                    ])->name('incoming.attachments.destroy');
                    Route::resource('incoming', IncomingLetterController::class);

                    // Outgoing
                    Route::get('outgoing/print', [OutgoingLetterController::class, 'print'])->name('outgoing.print');
                    Route::delete('outgoing/attachments/{attachment}', [
                        OutgoingLetterController::class,
                        'destroyAttachment',
                    ])->name('outgoing.attachments.destroy');
                    Route::resource('outgoing', OutgoingLetterController::class);

                    // SP
                    Route::get('validation-submission/generate/ipnu/{letter}', [
                        SPController::class,
                        'generateIPNUSP',
                    ])->name('validation-submission.generateIPNUSP');

                    Route::get('validation-submission/generate/ippnu/{letter}', [
                        SPController::class,
                        'generateIPPNUSP',
                    ])->name('validation-submission.generateIPPNUSP');

                    Route::resource('validation-submission', SPController::class);
                    Route::prefix('validation-submission')
                        ->as('validation-submission.')
                        ->group(function () {
                            Route::patch('{letter}/approve', [SPController::class, 'approve'])->name('approve');
                            Route::delete('{letter}/reject', [SPController::class, 'reject'])->name('reject');
                        });
                });
        });
});
