module.exports = {
    isSvgAvailable() {
        return Modernizr.svg;
    },

    showChannelsLogo() {
        Array.from(document.getElementsByClassName('channel-icon')).forEach(
            (logo) => {
                let noSvgLogos = [
                    'premiumcrime',
                    'premiumstories',
                    'premiumaction',
                ];

                let channelName = logo.className.split(' ')[1];

                if (noSvgLogos.includes(channelName) || this.isSvgAvailable()) {
                    logo.classList.add('no-svg', 'center-tv-logo');
                    logo.style.width = '120px';
                } else {
                    logo.className += svg;
                }
            },
        );
    },
};
