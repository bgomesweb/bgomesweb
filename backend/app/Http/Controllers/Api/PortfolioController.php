<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Award;
use App\Models\Certification;
use App\Models\ComplementaryCertificate;
use App\Models\Education;
use App\Models\Experience;
use App\Models\Profile;
use App\Models\Project;
use App\Models\SkillGroup;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Storage;

class PortfolioController extends Controller
{
    public function index(): JsonResponse
    {
        $profile = Profile::query()->firstOrFail();

        return response()->json([
            'profile' => $this->transformProfile($profile),
            'experiences' => Experience::query()
                ->orderBy('sort_order')
                ->get()
                ->map(fn (Experience $experience) => $this->transformExperience($experience)),
            'educations' => Education::query()
                ->orderBy('sort_order')
                ->get()
                ->map(fn (Education $education) => $this->transformEducation($education)),
            'certifications' => Certification::query()
                ->orderBy('sort_order')
                ->get()
                ->map(fn (Certification $certification) => $this->transformCertification($certification)),
            'skillGroups' => SkillGroup::query()
                ->with(['skills' => fn ($query) => $query->orderBy('sort_order')])
                ->orderBy('sort_order')
                ->get()
                ->map(fn (SkillGroup $skillGroup) => [
                    'category' => $skillGroup->category,
                    'skills' => $skillGroup->skills->pluck('name'),
                ]),
            'complementaryCertificates' => ComplementaryCertificate::query()
                ->orderBy('sort_order')
                ->get()
                ->map(fn (ComplementaryCertificate $certificate) => [
                    'id' => $certificate->id,
                    'name' => $certificate->name,
                    'issuer' => $certificate->issuer,
                ]),
            'awards' => Award::query()
                ->orderBy('sort_order')
                ->get()
                ->map(fn (Award $award) => [
                    'id' => $award->id,
                    'title' => $award->title,
                    'description' => $award->description,
                ]),
            'projects' => Project::query()
                ->orderBy('sort_order')
                ->get()
                ->map(fn (Project $project) => [
                    'id' => $project->id,
                    'name' => $project->name,
                    'description' => $project->description,
                    'technologies' => $project->technologies,
                    'url' => $project->url,
                    'repositoryUrl' => $project->repository_url,
                ]),
        ]);
    }

    private function transformProfile(Profile $profile): array
    {
        return [
            'name' => $profile->name,
            'title' => $profile->title,
            'summary' => $profile->summary,
            'location' => $profile->location,
            'phone' => $profile->phone,
            'whatsapp' => $profile->whatsapp,
            'email' => $profile->email,
            'linkedinUrl' => $profile->linkedin_url,
            'githubUrl' => $profile->github_url,
            'resumeUrl' => $profile->resume_path ? Storage::disk('public')->url($profile->resume_path) : null,
            'photoUrl' => $profile->photo_path ? Storage::disk('public')->url($profile->photo_path) : null,
        ];
    }

    private function transformExperience(Experience $experience): array
    {
        return [
            'id' => $experience->id,
            'company' => $experience->company,
            'role' => $experience->role,
            'startDate' => $experience->start_date->toDateString(),
            'endDate' => $experience->end_date?->toDateString(),
            'isCurrent' => $experience->is_current,
            'highlights' => $experience->highlights,
        ];
    }

    private function transformEducation(Education $education): array
    {
        return [
            'id' => $education->id,
            'institution' => $education->institution,
            'course' => $education->course,
            'startDate' => $education->start_date->toDateString(),
            'endDate' => $education->end_date?->toDateString(),
            'status' => $education->status,
            'description' => $education->description,
        ];
    }

    private function transformCertification(Certification $certification): array
    {
        return [
            'id' => $certification->id,
            'name' => $certification->name,
            'issuer' => $certification->issuer,
            'issuedAt' => $certification->issued_at->toDateString(),
            'expiresAt' => $certification->expires_at?->toDateString(),
            'credentialUrl' => $certification->credential_url,
            'fileUrl' => $certification->file_path ? Storage::disk('public')->url($certification->file_path) : null,
            'featured' => $certification->featured,
            'description' => $certification->description,
        ];
    }
}
