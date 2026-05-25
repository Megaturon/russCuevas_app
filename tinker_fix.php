
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;

Schema::table('quotes', function (Blueprint $table) {
    if (!Schema::hasColumn('quotes', 'deposit_percentage')) {
        $table->decimal('deposit_percentage', 5, 2)->default(50.00)->after('amount_paid');
    }
    if (!Schema::hasColumn('quotes', 'payment_type')) {
        $table->string('payment_type')->nullable()->after('deposit_percentage');
    }
    if (!Schema::hasColumn('quotes', 'paid_at')) {
        $table->timestamp('paid_at')->nullable()->after('payment_type');
    }
});
echo "Fixed deposit fields!\n";
