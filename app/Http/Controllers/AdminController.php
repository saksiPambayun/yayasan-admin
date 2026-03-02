<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\SantriRegistration;
use App\Models\Employee;
use App\Models\SkData;
use App\Models\AktaYayasan;
use App\Models\AktaWakaf;

class AdminController extends Controller
{
    // === TAMBAHAN REVISI: AUTH METHODS ===

    public function showLoginForm()
    {
        return view('admin.auth.login');
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            return redirect()->intended('admin/dashboard');
        }

        return back()->withErrors([
            'email' => 'Email atau password yang Anda masukkan salah.',
        ])->onlyInput('email');
    }

    // =====================================

    // Dashboard
    public function dashboard()
    {
        $stats = [
            'santri_pending' => SantriRegistration::where('status', 'pending')->count(),
            'santri_total' => SantriRegistration::count(),
            'santri_diterima' => SantriRegistration::where('status', 'diterima')->count(),
            'santri_ditolak' => SantriRegistration::where('status', 'ditolak')->count(),
            'pegawai_total' => Employee::where('status', 'aktif')->count(),
            'sk_total' => SkData::count(),
            'akta_yayasan_total' => AktaYayasan::count(),
            'akta_wakaf_total' => AktaWakaf::count(),
        ];

        $santri = SantriRegistration::latest()->paginate(5);

        return view('admin.dashboard', compact('stats', 'santri'));
    }

    // ==================== SANTRI ====================
    public function santriIndex()
    {
        $santri = SantriRegistration::latest()->paginate(10);
        return view('admin.santri.index', compact('santri'));
    }

    public function santriCreate()
    {
        return view('admin.santri.create');
    }

    public function santriStore(Request $request)
    {
        $validated = $request->validate([
            'nama_lengkap' => 'required|string|max:255',
            'nisn' => 'nullable|string|max:50',
            'asal_sekolah' => 'required|string|max:255',
            'tanggal_lahir' => 'nullable|date',
            'alamat' => 'nullable|string',
            'email' => 'nullable|email|max:255',
            'no_wali' => 'required|string|max:20',
        ]);

        SantriRegistration::create($validated);

        return redirect()->route('admin.santri.index')->with('success', 'Data santri berhasil ditambahkan');
    }

    public function santriShow($id)
    {
        $santri = SantriRegistration::findOrFail($id);
        return view('admin.santri.show', compact('santri'));
    }

    public function santriEdit($id)
    {
        $santri = SantriRegistration::findOrFail($id);
        return view('admin.santri.edit', compact('santri'));
    }

    public function santriUpdate(Request $request, $id)
    {
        $santri = SantriRegistration::findOrFail($id);

        $validated = $request->validate([
            'nama_lengkap' => 'required|string|max:255',
            'nisn' => 'nullable|string|max:50',
            'asal_sekolah' => 'required|string|max:255',
            'tanggal_lahir' => 'nullable|date',
            'alamat' => 'nullable|string',
            'email' => 'nullable|email|max:255',
            'no_wali' => 'required|string|max:20',
        ]);

        $santri->update($validated);

        return redirect()->route('admin.santri.index')->with('success', 'Data santri berhasil diupdate');
    }

    public function santriDestroy($id)
    {
        $santri = SantriRegistration::findOrFail($id);
        $santri->delete();

        return redirect()->route('admin.santri.index')->with('success', 'Data santri berhasil dihapus');
    }

    public function verifySantri($id)
    {
        $santri = SantriRegistration::findOrFail($id);
        $santri->update(['status' => 'diterima']);

        return back()->with('success', 'Santri berhasil diverifikasi');
    }

    // ==================== PEGAWAI ====================
    public function pegawaiIndex()
    {
        $pegawai = Employee::latest()->paginate(10);
        return view('admin.pegawai.index', compact('pegawai'));
    }

    public function pegawaiCreate()
    {
        return view('admin.pegawai.create');
    }

    public function pegawaiStore(Request $request)
    {
        $validated = $request->validate([
            'nip' => 'required|string|max:50|unique:employees,nip',
            'nama' => 'required|string|max:255',
            'jabatan' => 'nullable|string|max:100',
            'divisi' => 'nullable|string|max:100',
            'foto_ktp' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'foto_npwp' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'status' => 'nullable|in:aktif,cuti,nonaktif',
            'tanggal_bergabung' => 'nullable|date',
        ]);

        if ($request->hasFile('foto_ktp')) {
            $validated['foto_ktp'] = $request->file('foto_ktp')->store('ktp', 'public');
        }

        if ($request->hasFile('foto_npwp')) {
            $validated['foto_npwp'] = $request->file('foto_npwp')->store('npwp', 'public');
        }

        Employee::create($validated);

        return redirect()->route('admin.pegawai.index')->with('success', 'Data pegawai berhasil ditambahkan');
    }

    public function pegawaiShow($id)
    {
        $pegawai = Employee::findOrFail($id);
        return view('admin.pegawai.show', compact('pegawai'));
    }

    public function pegawaiEdit($id)
    {
        $pegawai = Employee::findOrFail($id);
        return view('admin.pegawai.edit', compact('pegawai'));
    }

    public function pegawaiUpdate(Request $request, $id)
    {
        $pegawai = Employee::findOrFail($id);

        $validated = $request->validate([
            'nip' => 'required|string|max:50|unique:employees,nip,' . $id,
            'nama' => 'required|string|max:255',
            'jabatan' => 'nullable|string|max:100',
            'divisi' => 'nullable|string|max:100',
            'foto_ktp' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'foto_npwp' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'status' => 'nullable|in:aktif,cuti,nonaktif',
            'tanggal_bergabung' => 'nullable|date',
        ]);

        if ($request->hasFile('foto_ktp')) {
            if ($pegawai->foto_ktp) {
                Storage::disk('public')->delete($pegawai->foto_ktp);
            }
            $validated['foto_ktp'] = $request->file('foto_ktp')->store('ktp', 'public');
        }

        if ($request->hasFile('foto_npwp')) {
            if ($pegawai->foto_npwp) {
                Storage::disk('public')->delete($pegawai->foto_npwp);
            }
            $validated['foto_npwp'] = $request->file('foto_npwp')->store('npwp', 'public');
        }

        $pegawai->update($validated);

        return redirect()->route('admin.pegawai.index')->with('success', 'Data pegawai berhasil diupdate');
    }

    public function pegawaiDestroy($id)
    {
        $pegawai = Employee::findOrFail($id);

        if ($pegawai->foto_ktp) {
            Storage::disk('public')->delete($pegawai->foto_ktp);
        }
        if ($pegawai->foto_npwp) {
            Storage::disk('public')->delete($pegawai->foto_npwp);
        }

        $pegawai->delete();

        return redirect()->route('admin.pegawai.index')->with('success', 'Data pegawai berhasil dihapus');
    }

    // ==================== SK ====================
    public function skIndex()
    {
        $sk = SkData::latest()->paginate(10);
        return view('admin.sk.index', compact('sk'));
    }

    public function skCreate()
    {
        return view('admin.sk.create');
    }

    public function skStore(Request $request)
    {
        $validated = $request->validate([
            'nomor_sk' => 'required|string|max:100',
            'tentang' => 'nullable|string|max:255',
            'tanggal_sk' => 'nullable|date',
            'file_sk' => 'nullable|file|mimes:pdf,doc,docx|max:5120',
        ]);

        if ($request->hasFile('file_sk')) {
            $validated['file_sk'] = $request->file('file_sk')->store('sk', 'public');
        }

        SkData::create($validated);

        return redirect()->route('admin.sk.index')->with('success', 'Data SK berhasil ditambahkan');
    }

    public function skShow($id)
    {
        $sk = SkData::findOrFail($id);
        return view('admin.sk.show', compact('sk'));
    }

    public function skEdit($id)
    {
        $sk = SkData::findOrFail($id);
        return view('admin.sk.edit', compact('sk'));
    }

    public function skUpdate(Request $request, $id)
    {
        $sk = SkData::findOrFail($id);

        $validated = $request->validate([
            'nomor_sk' => 'required|string|max:100',
            'tentang' => 'nullable|string|max:255',
            'tanggal_sk' => 'nullable|date',
            'file_sk' => 'nullable|file|mimes:pdf,doc,docx|max:5120',
        ]);

        if ($request->hasFile('file_sk')) {
            if ($sk->file_sk) {
                Storage::disk('public')->delete($sk->file_sk);
            }
            $validated['file_sk'] = $request->file('file_sk')->store('sk', 'public');
        }

        $sk->update($validated);

        return redirect()->route('admin.sk.index')->with('success', 'Data SK berhasil diupdate');
    }

    public function skDestroy($id)
    {
        $sk = SkData::findOrFail($id);

        if ($sk->file_sk) {
            Storage::disk('public')->delete($sk->file_sk);
        }

        $sk->delete();

        return redirect()->route('admin.sk.index')->with('success', 'Data SK berhasil dihapus');
    }

    // ==================== AKTA YAYASAN ====================
    public function aktaYayasanIndex()
    {
        $aktaYayasan = AktaYayasan::latest()->paginate(10);
        return view('admin.akta-yayasan.index', compact('aktaYayasan'));
    }

    public function aktaYayasanCreate()
    {
        return view('admin.akta-yayasan.create');
    }

    public function aktaYayasanStore(Request $request)
    {
        $validated = $request->validate([
            'nomor_akta' => 'nullable|string|max:100',
            'tanggal_akta' => 'nullable|date',
            'notaris' => 'nullable|string|max:255',
            'file_akta' => 'nullable|file|mimes:pdf,doc,docx|max:5120',
        ]);

        if ($request->hasFile('file_akta')) {
            $validated['file_akta'] = $request->file('file_akta')->store('akta-yayasan', 'public');
        }

        AktaYayasan::create($validated);

        return redirect()->route('admin.akta-yayasan.index')->with('success', 'Data Akta Yayasan berhasil ditambahkan');
    }

    public function aktaYayasanShow($id)
    {
        $aktaYayasan = AktaYayasan::findOrFail($id);
        return view('admin.akta-yayasan.show', compact('aktaYayasan'));
    }

    public function aktaYayasanEdit($id)
    {
        $aktaYayasan = AktaYayasan::findOrFail($id);
        return view('admin.akta-yayasan.edit', compact('aktaYayasan'));
    }

    public function aktaYayasanUpdate(Request $request, $id)
    {
        $aktaYayasan = AktaYayasan::findOrFail($id);

        $validated = $request->validate([
            'nomor_akta' => 'nullable|string|max:100',
            'tanggal_akta' => 'nullable|date',
            'notaris' => 'nullable|string|max:255',
            'file_akta' => 'nullable|file|mimes:pdf,doc,docx|max:5120',
        ]);

        if ($request->hasFile('file_akta')) {
            if ($aktaYayasan->file_akta) {
                Storage::disk('public')->delete($aktaYayasan->file_akta);
            }
            $validated['file_akta'] = $request->file('file_akta')->store('akta-yayasan', 'public');
        }

        $aktaYayasan->update($validated);

        return redirect()->route('admin.akta-yayasan.index')->with('success', 'Data Akta Yayasan berhasil diupdate');
    }

    public function aktaYayasanDestroy($id)
    {
        $aktaYayasan = AktaYayasan::findOrFail($id);

        if ($aktaYayasan->file_akta) {
            Storage::disk('public')->delete($aktaYayasan->file_akta);
        }

        $aktaYayasan->delete();

        return redirect()->route('admin.akta-yayasan.index')->with('success', 'Data Akta Yayasan berhasil dihapus');
    }

    // ==================== AKTA WAKAF ====================
    public function aktaWakafIndex()
    {
        $aktaWakaf = AktaWakaf::latest()->paginate(10);
        return view('admin.akta-wakaf.index', compact('aktaWakaf'));
    }

    public function aktaWakafCreate()
    {
        return view('admin.akta-wakaf.create');
    }

    public function aktaWakafStore(Request $request)
    {
        $validated = $request->validate([
            'nomor_sertifikat' => 'nullable|string|max:100',
            'nazhir' => 'nullable|string|max:255',
            'lokasi_tanah' => 'nullable|string|max:255',
            'luas_tanah' => 'nullable|string|max:50',
            'file_sertifikat' => 'nullable|file|mimes:pdf,doc,docx|max:5120',
        ]);

        if ($request->hasFile('file_sertifikat')) {
            $validated['file_sertifikat'] = $request->file('file_sertifikat')->store('akta-wakaf', 'public');
        }

        AktaWakaf::create($validated);

        return redirect()->route('admin.akta-wakaf.index')->with('success', 'Data Akta Wakaf berhasil ditambahkan');
    }

    public function aktaWakafShow($id)
    {
        $aktaWakaf = AktaWakaf::findOrFail($id);
        return view('admin.akta-wakaf.show', compact('aktaWakaf'));
    }

    public function aktaWakafEdit($id)
    {
        $aktaWakaf = AktaWakaf::findOrFail($id);
        return view('admin.akta-wakaf.edit', compact('aktaWakaf'));
    }

    public function aktaWakafUpdate(Request $request, $id)
    {
        $aktaWakaf = AktaWakaf::findOrFail($id);

        $validated = $request->validate([
            'nomor_sertifikat' => 'nullable|string|max:100',
            'nazhir' => 'nullable|string|max:255',
            'lokasi_tanah' => 'nullable|string|max:255',
            'luas_tanah' => 'nullable|string|max:50',
            'file_sertifikat' => 'nullable|file|mimes:pdf,doc,docx|max:5120',
        ]);

        if ($request->hasFile('file_sertifikat')) {
            if ($aktaWakaf->file_sertifikat) {
                Storage::disk('public')->delete($aktaWakaf->file_sertifikat);
            }
            $validated['file_sertifikat'] = $request->file('file_sertifikat')->store('akta-wakaf', 'public');
        }

        $aktaWakaf->update($validated);

        return redirect()->route('admin.akta-wakaf.index')->with('success', 'Data Akta Wakaf berhasil diupdate');
    }

    public function aktaWakafDestroy($id)
    {
        $aktaWakaf = AktaWakaf::findOrFail($id);

        if ($aktaWakaf->file_sertifikat) {
            Storage::disk('public')->delete($aktaWakaf->file_sertifikat);
        }

        $aktaWakaf->delete();

        return redirect()->route('admin.akta-wakaf.index')->with('success', 'Data Akta Wakaf berhasil dihapus');
    }

    // ==================== PROFILE ====================
    public function profile()
    {
        return view('admin.profile.index');
    }

    public function updateProfile(Request $request): RedirectResponse
    {
        /** @var \App\Models\User $user */
        $user = Auth::user();

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:users,email,' . $user->id,
            'phone' => 'nullable|string|max:20',
        ]);

        $user->update($validated);

        return back()->with('success', 'Profil berhasil diupdate');
    }

    public function changePassword(Request $request): RedirectResponse
    {
        $request->validate([
            'current_password' => 'required|current_password',
            'password' => 'required|min:8|confirmed',
        ]);

        /** @var \App\Models\User $user */
        $user = Auth::user();

        $user->update([
            'password' => Hash::make($request->password),
        ]);

        return back()->with('success', 'Password berhasil diubah');
    }

    public function changeEmail(Request $request): RedirectResponse
    {
        /** @var \App\Models\User $user */
        $user = Auth::user();

        $request->validate([
            // Kita ganti auth()->id() dengan $user->id yang sudah terdeteksi oleh VS Code
            'email' => 'required|email|max:255|unique:users,email,' . $user->id,
            'password' => 'required|current_password',
        ]);

        $user->update([
            'email' => $request->email,
        ]);

        return back()->with('success', 'Email berhasil diubah');
    }

    public function logout(Request $request)
    {
        Auth::logout(); // REVISI: Menggunakan Facade Auth lebih aman

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/login'); // REVISI: Redirect ke login setelah logout
    }
}
