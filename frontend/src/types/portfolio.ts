export interface Profile {
  name: string
  title: string
  summary: string
  location: string
  phone: string
  whatsapp: string
  email: string
  linkedinUrl: string
  githubUrl: string
  resumeUrl: string | null
  photoUrl: string | null
}

export interface Experience {
  id: number
  company: string
  role: string
  startDate: string
  endDate: string | null
  isCurrent: boolean
  highlights: string[]
}

export interface Education {
  id: number
  institution: string
  course: string
  startDate: string
  endDate: string | null
  status: string
  description: string | null
}

export interface Certification {
  id: number
  name: string
  issuer: string
  issuedAt: string
  expiresAt: string | null
  credentialUrl: string | null
  fileUrl: string | null
  featured: boolean
  description: string | null
}

export interface SkillGroup {
  category: string
  skills: string[]
}

export interface ComplementaryCertificate {
  id: number
  name: string
  issuer: string
}

export interface Award {
  id: number
  title: string
  description: string | null
}

export interface Project {
  id: number
  name: string
  description: string
  technologies: string[]
  url: string | null
  repositoryUrl: string | null
}

export interface PortfolioData {
  profile: Profile
  experiences: Experience[]
  educations: Education[]
  certifications: Certification[]
  skillGroups: SkillGroup[]
  complementaryCertificates: ComplementaryCertificate[]
  awards: Award[]
  projects: Project[]
}
