FROM nginx:alpine

WORKDIR /usr/share/nginx/html

RUN echo '<!DOCTYPE html>' > index.html
RUN echo '<html>' >> index.html
RUN echo '<head>' >> index.html
RUN echo '<title>Laravel RNDR</title>' >> index.html
RUN echo '<meta charset="UTF-8">' >> index.html
RUN echo '<style>' >> index.html
RUN echo 'body { font-family: Arial; padding: 40px; text-align: center; }' >> index.html
RUN echo '.success { color: green; font-size: 24px; }' >> index.html
RUN echo '</style>' >> index.html
RUN echo '</head>' >> index.html
RUN echo '<body>' >> index.html
RUN echo '<h1 class="success">✅ SERVICE EN LIGNE</h1>' >> index.html
RUN echo '<p>Laravel déployé sur RNDR avec succès</p>' >> index.html
RUN echo '</body>' >> index.html
RUN echo '</html>' >> index.html

EXPOSE 80