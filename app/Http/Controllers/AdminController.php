use App\Models\Proposal;
use App\Models\Student;
use App\Models\SubmissionSchedule;

class AdminController extends Controller
{
    public function dashboard()
    {
        // Mengambil statistik jumlah proposal
        $totalProposals = Proposal::count();
        $acceptedProposals = Proposal::whereHas('submission', function ($query) {
            $query->where('status', 'accepted');
        })->count();
        $rejectedProposals = Proposal::whereHas('submission', function ($query) {
            $query->where('status', 'rejected');
        })->count();

        return view('admin.dashboard', compact('totalProposals', 'acceptedProposals', 'rejectedProposals'));
    }

    public function addStudent(Request $request)
    {
        // Validasi data mahasiswa
        $request->validate([
            'name' => 'required|string|max:255',
            'nim' => 'required|string|unique:students', // memastikan NIM unik
        ], [
            'nim.unique' => 'NIM yang Anda masukkan sudah terdaftar.',
            'name.required' => 'Nama mahasiswa wajib diisi.',
        ]);

        // Menambahkan mahasiswa baru
        Student::create([
            'name' => $request->name,
            'nim' => $request->nim,
        ]);

        // Mengarahkan kembali dengan pesan sukses
        return redirect()->route('admin.dashboard')->with('success', 'Mahasiswa berhasil ditambahkan.');
    }

    public function createSchedule(Request $request)
    {
        // Validasi tanggal pengajuan
        $request->validate([
            'tanggal' => 'required|date|after_or_equal:today', // memastikan tanggal tidak di masa lalu
        ], [
            'tanggal.required' => 'Tanggal pengajuan wajib diisi.',
            'tanggal.date' => 'Format tanggal tidak valid.',
            'tanggal.after_or_equal' => 'Tanggal pengajuan tidak boleh lebih dari hari ini.',
        ]);

        // Membuat jadwal pengajuan
        SubmissionSchedule::create([
            'tanggal' => $request->tanggal,
        ]);

        // Mengarahkan kembali dengan pesan sukses
        return redirect()->route('admin.dashboard')->with('success', 'Jadwal pengajuan berhasil dibuat.');
    }
}
