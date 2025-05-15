namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class PaymentProof extends Model
{
    use HasFactory;

    protected $fillable = ['donation_id', 'image_path'];

    public function donation()
    {
        return $this->belongsTo(Donation::class);
    }
}
