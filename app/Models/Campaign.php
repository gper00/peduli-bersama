namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Campaign extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id', 'title', 'description', 'target_amount',
        'current_amount', 'deadline', 'is_private', 'status', 'thumbnail'
    ];

    public function creator()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function donations()
    {
        return $this->hasMany(Donation::class);
    }

    public function fundReports()
    {
        return $this->hasMany(FundReport::class);
    }
}
