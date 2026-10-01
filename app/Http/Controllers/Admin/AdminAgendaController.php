<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ActivityLog;
use App\Models\Agenda;
use App\Models\Pengumuman;
use App\Services\WebpService;
use Illuminate\Http\Request;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class AdminAgendaController extends Controller
{
    public function __construct(
        protected WebpService $webpService
    ) {}

    public function index()
    {
        $agendas = Agenda::latest('event_date')->paginate(10, ['*'], 'agenda_page');
        $pengumumen = Pengumuman::latest()->paginate(10, ['*'], 'pengumuman_page');

        return view('admin.agenda.index', compact('agendas', 'pengumumen'));
    }

    public function storeAgenda(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'event_date' => 'required|date',
            'location' => 'required|string|max:255',
            'content' => 'nullable|string',
            'status' => 'required|in:upcoming,ongoing,completed,publish,draft',
            'featured_image' => 'nullable|image|mimes:jpeg,png,jpg,webp,gif|max:5120',
            'file_attachment' => 'nullable|file|mimes:pdf,doc,docx,xls,xlsx,ppt,pptx,zip,rar,jpg,jpeg,png|max:20480',
        ]);

        $featuredImageUrl = null;
        if ($request->hasFile('featured_image')) {
            $converted = $this->webpService->processUploadedFile($request->file('featured_image'), 'agenda', 85, 1200);
            if ($converted['success']) {
                $featuredImageUrl = $converted['url'];
            }
        }

        $fileAttachmentUrl = null;
        if ($request->hasFile('file_attachment')) {
            $fileAttachmentUrl = $this->handleFileUpload($request->file('file_attachment'), 'agenda');
        }

        $agenda = Agenda::create([
            'title' => $validated['title'],
            'slug' => Str::slug($validated['title']).'-'.time(),
            'event_date' => $validated['event_date'],
            'location' => $validated['location'],
            'content' => $validated['content'] ?? '',
            'status' => $validated['status'],
            'featured_image' => $featuredImageUrl,
            'file_attachment' => $fileAttachmentUrl,
        ]);

        ActivityLog::create([
            'user_id' => Auth::id(),
            'user_name' => Auth::user()->name,
            'action' => 'agenda_create',
            'description' => "Menambahkan Agenda Kegiatan: {$agenda->title}",
            'ip_address' => $request->ip(),
            'user_agent' => $request->userAgent(),
            'status' => 'info',
        ]);

        return back()->with('success', 'Agenda kegiatan berhasil ditambahkan.');
    }

    public function destroyAgenda(Request $request, Agenda $agenda)
    {
        $title = $agenda->title;
        $agenda->delete();

        ActivityLog::create([
            'user_id' => Auth::id(),
            'user_name' => Auth::user()->name,
            'action' => 'agenda_delete',
            'description' => "Menghapus Agenda Kegiatan: {$title}",
            'ip_address' => $request->ip(),
            'user_agent' => $request->userAgent(),
            'status' => 'warning',
        ]);

        return back()->with('success', 'Agenda kegiatan berhasil dihapus.');
    }

    public function updateAgenda(Request $request, Agenda $agenda)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'event_date' => 'required|date',
            'location' => 'required|string|max:255',
            'content' => 'nullable|string',
            'status' => 'required|in:upcoming,ongoing,completed,publish,draft',
            'featured_image' => 'nullable|image|mimes:jpeg,png,jpg,webp,gif|max:5120',
            'file_attachment' => 'nullable|file|mimes:pdf,doc,docx,xls,xlsx,ppt,pptx,zip,rar,jpg,jpeg,png|max:20480',
            'remove_featured_image' => 'nullable|boolean',
            'remove_file_attachment' => 'nullable|boolean',
        ]);

        $data = [
            'title' => $validated['title'],
            'event_date' => $validated['event_date'],
            'location' => $validated['location'],
            'content' => $validated['content'] ?? '',
            'status' => $validated['status'],
        ];

        if ($request->hasFile('featured_image')) {
            $converted = $this->webpService->processUploadedFile($request->file('featured_image'), 'agenda', 85, 1200);
            if ($converted['success']) {
                $data['featured_image'] = $converted['url'];
            }
        } elseif ($request->boolean('remove_featured_image')) {
            $data['featured_image'] = null;
        }

        if ($request->hasFile('file_attachment')) {
            $data['file_attachment'] = $this->handleFileUpload($request->file('file_attachment'), 'agenda');
        } elseif ($request->boolean('remove_file_attachment')) {
            $data['file_attachment'] = null;
        }

        $agenda->update($data);

        ActivityLog::create([
            'user_id' => Auth::id(),
            'user_name' => Auth::user()->name,
            'action' => 'agenda_update',
            'description' => "Memperbarui Agenda Kegiatan: {$agenda->title}",
            'ip_address' => $request->ip(),
            'user_agent' => $request->userAgent(),
            'status' => 'info',
        ]);

        return redirect()->route('admin.agenda.index')->with('success', 'Agenda kegiatan berhasil diperbarui.');
    }

    public function storePengumuman(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'status' => 'required|in:publish,draft',
            'featured_image' => 'nullable|image|mimes:jpeg,png,jpg,webp,gif|max:5120',
            'file_attachment' => 'nullable|file|mimes:pdf,doc,docx,xls,xlsx,ppt,pptx,zip,rar,jpg,jpeg,png|max:20480',
        ]);

        $featuredImageUrl = null;
        if ($request->hasFile('featured_image')) {
            $converted = $this->webpService->processUploadedFile($request->file('featured_image'), 'pengumuman', 85, 1200);
            if ($converted['success']) {
                $featuredImageUrl = $converted['url'];
            }
        }

        $fileAttachmentUrl = null;
        if ($request->hasFile('file_attachment')) {
            $fileAttachmentUrl = $this->handleFileUpload($request->file('file_attachment'), 'pengumuman');
        }

        $pengumuman = Pengumuman::create([
            'title' => $validated['title'],
            'slug' => Str::slug($validated['title']).'-'.time(),
            'content' => $validated['content'],
            'status' => $validated['status'],
            'featured_image' => $featuredImageUrl,
            'file_attachment' => $fileAttachmentUrl,
        ]);

        ActivityLog::create([
            'user_id' => Auth::id(),
            'user_name' => Auth::user()->name,
            'action' => 'pengumuman_create',
            'description' => "Menambahkan Pengumuman Resmi: {$pengumuman->title}",
            'ip_address' => $request->ip(),
            'user_agent' => $request->userAgent(),
            'status' => 'info',
        ]);

        return redirect()->route('admin.agenda.index')->with('success', 'Pengumuman resmi berhasil diterbitkan.');
    }

    public function updatePengumuman(Request $request, Pengumuman $pengumuman)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'status' => 'required|in:publish,draft',
            'featured_image' => 'nullable|image|mimes:jpeg,png,jpg,webp,gif|max:5120',
            'file_attachment' => 'nullable|file|mimes:pdf,doc,docx,xls,xlsx,ppt,pptx,zip,rar,jpg,jpeg,png|max:20480',
            'remove_featured_image' => 'nullable|boolean',
            'remove_file_attachment' => 'nullable|boolean',
        ]);

        $data = [
            'title' => $validated['title'],
            'content' => $validated['content'],
            'status' => $validated['status'],
        ];

        if ($request->hasFile('featured_image')) {
            $converted = $this->webpService->processUploadedFile($request->file('featured_image'), 'pengumuman', 85, 1200);
            if ($converted['success']) {
                $data['featured_image'] = $converted['url'];
            }
        } elseif ($request->boolean('remove_featured_image')) {
            $data['featured_image'] = null;
        }

        if ($request->hasFile('file_attachment')) {
            $data['file_attachment'] = $this->handleFileUpload($request->file('file_attachment'), 'pengumuman');
        } elseif ($request->boolean('remove_file_attachment')) {
            $data['file_attachment'] = null;
        }

        $pengumuman->update($data);

        ActivityLog::create([
            'user_id' => Auth::id(),
            'user_name' => Auth::user()->name,
            'action' => 'pengumuman_update',
            'description' => "Memperbarui Pengumuman: {$pengumuman->title}",
            'ip_address' => $request->ip(),
            'user_agent' => $request->userAgent(),
            'status' => 'info',
        ]);

        return redirect()->route('admin.agenda.index')->with('success', 'Pengumuman resmi berhasil diperbarui.');
    }

    public function destroyPengumuman(Request $request, Pengumuman $pengumuman)
    {
        $title = $pengumuman->title;
        $pengumuman->delete();

        ActivityLog::create([
            'user_id' => Auth::id(),
            'user_name' => Auth::user()->name,
            'action' => 'pengumuman_delete',
            'description' => "Menghapus Pengumuman: {$title}",
            'ip_address' => $request->ip(),
            'user_agent' => $request->userAgent(),
            'status' => 'warning',
        ]);

        return back()->with('success', 'Pengumuman berhasil dihapus.');
    }

    /**
     * Handle document / generic file upload and return public URL.
     */
    protected function handleFileUpload(UploadedFile $file, string $subfolder = 'documents'): ?string
    {
        $originalName = pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME);
        $ext = strtolower($file->getClientOriginalExtension());
        $slugName = Str::slug($originalName) ?: 'document';
        $uniqueName = $slugName.'-'.time().'-'.Str::random(5).'.'.$ext;

        $relativeDirectory = 'uploads/'.trim($subfolder, '/');
        $targetDir = public_path($relativeDirectory);

        if (! is_dir($targetDir)) {
            mkdir($targetDir, 0755, true);
        }

        $file->move($targetDir, $uniqueName);
        $filePath = '/'.$relativeDirectory.'/'.$uniqueName;

        // Mirror file to active web document roots (cPanel separate docroot support)
        $docRootCandidates = array_filter([
            $_SERVER['DOCUMENT_ROOT'] ?? null,
        ]);

        foreach ($docRootCandidates as $docRoot) {
            if ($docRoot && is_dir($docRoot) && realpath($docRoot) !== realpath(public_path())) {
                $mirrorDir = rtrim($docRoot, '/\\').'/'.$relativeDirectory;
                if (! is_dir($mirrorDir)) {
                    @mkdir($mirrorDir, 0755, true);
                }
                @copy($targetDir.'/'.$uniqueName, $mirrorDir.'/'.$uniqueName);
            }
        }

        return $filePath;
    }
}
