<?php
// app/Providers/RepositoryServiceProvider.php
namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Repositories\Interfaces\ProductRepositoryInterface;
use App\Repositories\ProductRepository;
use App\Repositories\Interfaces\DashboardRepositoryInterface;
use App\Repositories\DashboardRepository;
use App\Repositories\Interfaces\ReportRepositoryInterface;
use App\Repositories\ReportRepository;
use App\Repositories\Interfaces\StockRepositoryInterface;
use App\Repositories\StockRepository;
use App\Repositories\Interfaces\CategoryRepositoryInterface;
use App\Repositories\CategoryRepository;
use App\Repositories\Interfaces\ProductAttributeRepositoryInterface;
use App\Repositories\ProductAttributeRepository;
use App\Repositories\Interfaces\SupplierRepositoryInterface;
use App\Repositories\SupplierRepository;
use App\Repositories\Interfaces\UserRepositoryInterface;
use App\Repositories\UserRepository;
use App\Repositories\Interfaces\SettingRepositoryInterface;
use App\Repositories\SettingRepository;
use Log;

class RepositoryServiceProvider extends ServiceProvider
{
    public function register()
    {
        // Binding untuk ProductRepository
        $this->app->bind(ProductRepositoryInterface::class, ProductRepository::class);
        
        // Binding untuk DashboardRepository
        $this->app->bind(DashboardRepositoryInterface::class, DashboardRepository::class);

        // Binding untuk ReportRepository
        $this->app->bind(ReportRepositoryInterface::class, ReportRepository::class);

        // Binding untuk StockRepository
        $this->app->bind(StockRepositoryInterface::class, StockRepository::class);

         // Bind interface CategoryRepositoryInterface ke implementasinya CategoryRepository
        $this->app->bind(CategoryRepositoryInterface::class, CategoryRepository::class);

         // Binding untuk Product Attribute Repository
        $this->app->bind(ProductAttributeRepositoryInterface::class, ProductAttributeRepository::class);

         // Binding Supplier
        $this->app->bind(SupplierRepositoryInterface::class, SupplierRepository::class);

          // Binding untuk User
        $this->app->bind(UserRepositoryInterface::class, UserRepository::class);

        // Binding untuk Setting
        $this->app->bind(SettingRepositoryInterface::class, SettingRepository::class);
    }
}
