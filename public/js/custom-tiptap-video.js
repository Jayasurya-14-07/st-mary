export default () => {
  const { Node, mergeAttributes } = window.FilamentRichEditor.tiptap.core

  const Youtube = Node.create({
    name: 'youtube',
    group: 'block',
    atom: true,
    draggable: true,

    addAttributes() {
      return {
        src: {
          default: null,
          parseHTML: element => element.getAttribute('src'),
        }
      }
    },

    parseHTML() {
      return [
        {
          tag: 'div[data-youtube-video] iframe',
        },
        {
          tag: 'iframe[src*="youtube.com"]',
        },
        {
          tag: 'iframe[src*="youtu.be"]',
        },
      ]
    },

    renderHTML({ HTMLAttributes }) {
      const src = HTMLAttributes.src
      let embedUrl = src

      if (src && !src.includes('embed/')) {
        const match = src.match(/(?:youtube(?:-nocookie)?\.com\/(?:[^/]+\/.+\/|(?:v|e(?:mbed)?|shorts|live)\/|.*[?&]v=)|youtu\.be\/)([^"&?/ ]{11})/i)
        if (match) {
          embedUrl = `https://www.youtube.com/embed/${match[1]}`
        }
      }

      return [
        'div',
        {
          'data-youtube-video': '',
          class: 'tiptap-youtube-wrapper',
          style: 'position: relative; width: 100%; aspect-ratio: 16 / 9; margin: 1rem 0;',
        },
        [
          'iframe',
          {
            src: embedUrl,
            width: '100%',
            height: '100%',
            style: 'position: absolute; top: 0; left: 0; width: 100%; height: 100%;',
            frameborder: '0',
            allow: 'accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture',
            allowfullscreen: 'allowfullscreen',
          },
        ],
      ]
    },
  })

  const Vimeo = Node.create({
    name: 'vimeo',
    group: 'block',
    atom: true,
    draggable: true,

    addAttributes() {
      return {
        src: {
          default: null,
          parseHTML: element => element.getAttribute('src'),
        }
      }
    },

    parseHTML() {
      return [
        {
          tag: 'div[data-vimeo-video] iframe',
        },
        {
          tag: 'iframe[src*="vimeo.com"]',
        },
      ]
    },

    renderHTML({ HTMLAttributes }) {
      const src = HTMLAttributes.src
      let embedUrl = src

      if (src && !src.includes('player.vimeo.com')) {
        const match = src.match(/^https?:\/\/(?:www\.|player\.)?vimeo.com\/(?:channels\/(?:\w+\/)?|groups\/([^/]*)\/videos\/|album\/(\d+)\/video\/|video\/|)(\d+)(?:$|\/|\?)/i)
        if (match) {
          embedUrl = `https://player.vimeo.com/video/${match[3]}`
        }
      }

      return [
        'div',
        {
          'data-vimeo-video': '',
          class: 'tiptap-vimeo-wrapper',
          style: 'position: relative; width: 100%; aspect-ratio: 16 / 9; margin: 1rem 0;',
        },
        [
          'iframe',
          {
            src: embedUrl,
            width: '100%',
            height: '100%',
            style: 'position: absolute; top: 0; left: 0; width: 100%; height: 100%;',
            frameborder: '0',
            allow: 'autoplay; fullscreen; picture-in-picture',
            allowfullscreen: 'allowfullscreen',
          },
        ],
      ]
    },
  })

  const Video = Node.create({
    name: 'video',
    group: 'block',
    atom: true,
    draggable: true,
  
    addAttributes() {
      return {
        src: {
          default: null,
          parseHTML: element => element.getAttribute('src'),
        }
      }
    },
  
    parseHTML() {
      return [
        {
          tag: 'video',
        },
      ]
    },
  
    renderHTML({ HTMLAttributes }) {
      return [
        'video',
        mergeAttributes(HTMLAttributes, {
          width: '100%',
          style: 'width: 100%; aspect-ratio: 16 / 9;',
          controls: 'controls',
        }),
      ]
    },
  })

  return [Youtube, Vimeo, Video]
}
