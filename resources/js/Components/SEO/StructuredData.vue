<template>
  <!-- Ce composant ajoute les données structurées Schema.org -->
  <div v-if="structuredData" style="display: none;">
    <script type="application/ld+json" v-html="structuredData"></script>
  </div>
</template>

<script>
export default {
  name: 'StructuredData',
  props: {
    type: {
      type: String,
      default: 'Organization' // Organization, Product, LocalBusiness, etc.
    },
    data: {
      type: Object,
      default: () => ({})
    }
  },
  computed: {
    structuredData() {
      const baseData = this.getBaseData();
      const mergedData = { ...baseData, ...this.data };
      return JSON.stringify(mergedData, null, 2);
    }
  },
  methods: {
    getBaseData() {
      const schemas = {
        Organization: {
          '@context': 'https://schema.org',
          '@type': 'Organization',
          'name': 'NoflayHub',
          'url': 'https://noflayhub.com',
          'logo': 'https://noflayhub.com/logo.png',
          'description': 'Marketplace immobilier et automobile au Sénégal',
          'sameAs': [
            'https://facebook.com/noflayhub',
            'https://twitter.com/noflayhub',
            'https://instagram.com/noflayhub'
          ],
          'contactPoint': {
            '@type': 'ContactPoint',
            'telephone': '+221-33-123-45-67',
            'contactType': 'Customer Service',
            'email': 'contact@noflayhub.com',
            'url': 'https://noflayhub.com/contact'
          }
        },
        RealEstateAgent: {
          '@context': 'https://schema.org',
          '@type': 'RealEstateAgent',
          'name': 'NoflayHub',
          'url': 'https://noflayhub.com',
          'image': 'https://noflayhub.com/logo.png',
          'areaServed': [
            'Dakar',
            'Thiès',
            'Saint-Louis',
            'Kaolack',
            'Tambacounda',
            'Ziguinchor',
            'Kolda'
          ]
        },
        LocalBusiness: {
          '@context': 'https://schema.org',
          '@type': 'LocalBusiness',
          'name': 'NoflayHub',
          'url': 'https://noflayhub.com',
          'address': {
            '@type': 'PostalAddress',
            'addressCountry': 'SN',
            'addressLocality': 'Dakar'
          },
          'telephone': '+221-33-123-45-67',
          'email': 'contact@noflayhub.com'
        },
        Product: {
          '@context': 'https://schema.org',
          '@type': 'Product',
          'name': '',
          'description': '',
          'image': '',
          'offers': {
            '@type': 'Offer',
            'price': '',
            'priceCurrency': 'XOF',
            'availability': 'https://schema.org/InStock'
          }
        },
        BreadcrumbList: {
          '@context': 'https://schema.org',
          '@type': 'BreadcrumbList',
          'itemListElement': []
        }
      };

      return schemas[this.type] || schemas.Organization;
    }
  }
};
</script>

