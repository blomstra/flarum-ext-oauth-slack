import app from 'flarum/admin/app';
import { extend } from 'flarum/common/extend';
import { AuthSettingsPage } from '@fof-oauth';
import UploadKeyFileButton from './components/UploadKeyFileButton';

export default function ExtendOAuthSettings() {
  extend(AuthSettingsPage.prototype, 'customProviderSettings', function (items, name) {
    if (name !== 'slack') return;

    items.add(
      'apple-keyfile-upload',
      <div className="Form-group">
        <fieldset>
          <legend>{app.translator.trans('fof-oauth.admin.settings.providers.apple.keyfile_upload_label')}</legend>
          <div className="helpText">
            {app.translator.trans('fof-oauth.admin.settings.providers.apple.keyfile_upload_help', {
              a: <a href="https://developer.apple.com/account/resources/authkeys/list" target="_blank" />,
            })}
          </div>
          <UploadKeyFileButton name="apple-keyfile" />
        </fieldset>
      </div>,
      100
    );
  });
}
