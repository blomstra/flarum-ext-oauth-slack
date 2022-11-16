import app from 'flarum/admin/app';
import { ConfigureWithOAuthPage } from '@fof-oauth';

app.initializers.add('blomstra/oauth-slack', () => {
  app.extensionData.for('blomstra-oauth-slack').registerPage(ConfigureWithOAuthPage);
});
