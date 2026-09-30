<script setup lang="ts">
import { usePortfolioData } from '@/composables/usePortfolioData'
import { trackVisit } from '@/composables/useVisitTracking'

import NavBar from '@/components/NavBar.vue'
import HeroSection from '@/components/HeroSection.vue'
import AboutSection from '@/components/AboutSection.vue'
import CertificationHighlight from '@/components/CertificationHighlight.vue'
import SkillsSection from '@/components/SkillsSection.vue'
import ExperienceSection from '@/components/ExperienceSection.vue'
import EducationSection from '@/components/EducationSection.vue'
import ProjectsSection from '@/components/ProjectsSection.vue'
import ContactSection from '@/components/ContactSection.vue'
import FooterSection from '@/components/FooterSection.vue'
import WhatsAppButton from '@/components/WhatsAppButton.vue'
import LoadingScreen from '@/components/LoadingScreen.vue'
import ErrorScreen from '@/components/ErrorScreen.vue'

const { data, isLoading, error, refetch } = usePortfolioData()

trackVisit()
</script>

<template>
  <LoadingScreen v-if="isLoading" />
  <ErrorScreen v-else-if="error" :message="error" @retry="refetch" />

  <template v-else-if="data">
    <NavBar :profile="data.profile" />

    <main>
      <HeroSection :profile="data.profile" />
      <AboutSection :profile="data.profile" />
      <CertificationHighlight
        :certifications="data.certifications"
        :complementary-certificates="data.complementaryCertificates"
      />
      <SkillsSection :skill-groups="data.skillGroups" />
      <ExperienceSection :experiences="data.experiences" />
      <EducationSection :educations="data.educations" :awards="data.awards" />
      <ProjectsSection :projects="data.projects" />
      <ContactSection :profile="data.profile" />
    </main>

    <FooterSection :profile="data.profile" />
    <WhatsAppButton />
  </template>
</template>
