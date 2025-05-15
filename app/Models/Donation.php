namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Donation extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id', 'campaign_id', 'amount',
        'message', 'is_anonymous', 'status'
    ];

    public function donor()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function campaign()
    {
        return $this->belongsTo(Campaign::class);
    }

    public function paymentProof()
    {
        return $this->hasOne(PaymentProof::class);
    }
}
