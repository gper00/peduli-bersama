namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class FundReport extends Model
{
    use HasFactory;

    protected $fillable = ['campaign_id', 'title', 'description', 'attachment'];

    public function campaign()
    {
        return $this->belongsTo(Campaign::class);
    }
}
